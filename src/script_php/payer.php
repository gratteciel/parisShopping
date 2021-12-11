<?php  
    include('../bdd/donneeSession.php');
    include('../bdd/connectBDD.php');
    include('Quantite/checkQuantite.php');
    $erreur=0;

    if(empty($_POST["adressePayer"])  || empty($_POST["paiementPayer"]) || empty($_POST["codeSecuPayer"])){
        $erreur++;
       
    }
    if(!is_numeric($_POST["codeSecuPayer"])){
        $erreur++;
    }
    if(strlen($_POST["codeSecuPayer"])!=3)
        $erreur++;
     
    
    //Check si code de sécu est bon
    $resultat = requeteSqlArray("SELECT codeSecurite,numeroCarte from paiement where idPaiement = '{$_POST['paiementPayer']}' and utilisateurId = '{$_SESSION['idUtilisateur']}'",$pdo);
   
   
    
    if(sizeof($resultat)!=1){
        $erreur++;
    }
    //Si le code de sécurité n'est pas bon!
    else if($_POST["codeSecuPayer"]!=$resultat[0]['codeSecurite']){
        header('Location: ../index.php?page=panier/panier&err=codeSecuPasBon&val='.substr($resultat[0]['numeroCarte'], -4));
        exit();
    }

   
    if($erreur==0){
        //Chargement des articles dans le panier
        $articlesPanier = requeteSqlArray("SELECT * from article a, articleInPanier ap where a.idArticle = ap.articleId and (ap.utilisateurId = '{$_SESSION['idUtilisateur']}')",$pdo);

        //Chargement des articles IMMEDIATS dans le panier
        $articlesImmediatPanier = requeteSqlArray("SELECT * from article a, articleimmediat ai, articleInPanier ap where a.idArticle = ai.idArticle and a.idArticle = ap.articleId and (ap.utilisateurId = '{$_SESSION['idUtilisateur']}')",$pdo);

        //Si il n'y a aucun article dans le panier
        if(sizeof($articlesImmediatPanier)==0){
            header('Location: ../index.php?page=panier/panier&err=aucunArticle&val=1');
            exit();
        }

        $articlePannierGrouped;

        //On groupe les memes articles et on leur ajouter la quantité
        foreach($articlesPanier as $a){
            if(isset($articlePannierGrouped[$a['idArticle']]['quantitePanier']))
                $articlePannierGrouped[$a['idArticle']]['quantitePanier']++;
            else{
                $articlePannierGrouped[$a['idArticle']]['quantitePanier']=1;
                $articlePannierGrouped[$a['idArticle']]['quantiteSite']=$a['quantite'];
                $articlePannierGrouped[$a['idArticle']]['idArticle']=$a['idArticle'];
                $articlePannierGrouped[$a['idArticle']]['nom']=$a['nom'];
            }
                
        }
        
        //Pour tous les articles identiques :
        //On check la quantité
        foreach($articlePannierGrouped as $a){
           
            if($a['quantiteSite'] - $a['quantitePanier']<0){ //Si la quantité du site - la quantité du panier est inférieur ou égal à 0
                if($a['quantiteSite']==0){
                    header('Location: ../index.php?page=panier/panier&err=prblQuantite&val='.$a['nom']);
                    exit();
                }
                else{ //Si on demande d'en acheter trop !
                    header('Location: ../index.php?page=panier/panier&err=prblQuantitePanier&val='.$a['nom'].'&val2=' .$a['quantiteSite']);
                    exit(); 
                }
                
            }

        }
        
        $paiement = requeteSqlArray("SELECT * from paiement where idPaiement = '{$_POST["paiementPayer"]}' and utilisateurId = '{$_SESSION['idUtilisateur']}'",$pdo);

        date_default_timezone_set('Europe/Paris');
        $dateJour = date('Y-m-d', time());
        if($dateJour >= $paiement[0]['dateExpiration']){
            header('Location: ../index.php?page=panier/panier&err=dateExpiration&val='.$paiement[0]['dateExpiration']);
            exit();
        }

       

        
        
        //SI ON ARRIVE ICI C'EST QUE LE PAIEMENT VA AVOIR LIEU
        

        //On baisse la quantité d'article et on augmente le nombreVendu dans la base
        foreach($articlePannierGrouped as $a){
            requeteSqlArray("UPDATE article SET quantite= quantite - '{$a['quantitePanier']}', nombreVendu = nombreVendu + '{$a['quantitePanier']}' where idArticle = '{$a['idArticle']}'",$pdo);
        
            checkQuantiteNotification($a['idArticle'],$a['nom'],$a['quantiteSite']-$a['quantitePanier'],$a['quantiteSite'],$pdo);
        }

        //Création de paiementLog
        requeteSqlArray("INSERT INTO paiementLog (typeCarte,numeroCarte,nomCarte,codeSecurite,dateExpiration)  values ('{$paiement[0]['typeCarte']}','{$paiement[0]['numeroCarte']}','{$paiement[0]['nomCarte']}','{$paiement[0]['codeSecurite']}','{$paiement[0]['dateExpiration']}');",$pdo);
        $idPaiementLog=requeteSqlArray("SELECT LAST_INSERT_ID();",$pdo);
        

        //Création de adresseLog
        $adresse = requeteSqlArray("SELECT * from adresse where idAdresse = '{$_POST["adressePayer"]}' and utilisateurId = '{$_SESSION['idUtilisateur']}'",$pdo);
        requeteSqlArray("INSERT INTO adresseLog (numeroVoie,rue,ville,codePostal,nom,pays) values ('{$adresse[0]['numeroVoie']}','{$adresse[0]['rue']}','{$adresse[0]['ville']}','{$adresse[0]['codePostal']}','{$adresse[0]['nom']}','{$adresse[0]['pays']}');",$pdo);
        $idAdresseLog=requeteSqlArray("SELECT LAST_INSERT_ID();",$pdo);

        date_default_timezone_set('Europe/Paris');
        $date = date('Y-m-d H:i:s', time());

        //Création de commandeLog
        requeteSqlArray("INSERT INTO commandeLog (dateCommande,utilisateurId,idAdresseLog,idPaiementLog) values ('{$date}','{$_SESSION['idUtilisateur']}','{$idAdresseLog[0]['LAST_INSERT_ID()']}','{$idPaiementLog[0]['LAST_INSERT_ID()']}');",$pdo);
        $idCommandeLog=requeteSqlArray("SELECT LAST_INSERT_ID();",$pdo);

        //Ajout de idCommandeLog dans paimentLog et adresseLog
        requeteSqlArray("UPDATE paiementLog SET idCommandeLog='{$idCommandeLog[0]['LAST_INSERT_ID()']}' where idPaiementLog = '{$idPaiementLog[0]['LAST_INSERT_ID()']}'",$pdo);
        requeteSqlArray("UPDATE adresseLog SET idCommandeLog='{$idCommandeLog[0]['LAST_INSERT_ID()']}' where idAdresseLog = '{$idAdresseLog[0]['LAST_INSERT_ID()']}'",$pdo);
        
        
        //Création d'une notification
        requeteSqlArray("INSERT INTO notification (nom,descriptionNotif,dateNotif,idUtilisateur,vu,lien) values ('Commande','Votre commande (Ref: {$idCommandeLog[0]['LAST_INSERT_ID()']}) a bien été pris en compte','{$date}','{$_SESSION['idUtilisateur']}',0,'commande&id={$idCommandeLog[0]['LAST_INSERT_ID()']}');",$pdo);

       

        //Création de ligne dans articleLog pour tous les articles immédiats
        foreach($articlesImmediatPanier as $a){
            requeteSqlArray("INSERT INTO articlelog (prixAchat,articleId,commandeLogId) values ('{$a['prixActuel']}','{$a['articleId']}','{$idCommandeLog[0]['LAST_INSERT_ID()']}');",$pdo);
        }

        requeteSqlArray("DELETE FROM articleInPanier where utilisateurId ='{$_SESSION["idUtilisateur"]}' ",$pdo);

      


    }

    //Redirection vers l'historique des commandes
    header('Location: ../index.php?page=panier/panier&alerts=1&tA=payer&valA='.$idCommandeLog[0]['LAST_INSERT_ID()']);
    exit();
 ?>