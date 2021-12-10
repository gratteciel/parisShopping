<?php  
    include('../bdd/donneeSession.php');
    include('../bdd/connectBDD.php');
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
    var_dump($_POST);
   
    if($erreur==0){
        //Création de paiementLog
        $paiement = requeteSqlArray("SELECT * from paiement where idPaiement = '{$_POST["paiementPayer"]}' and utilisateurId = '{$_SESSION['idUtilisateur']}'",$pdo);
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

        
        
        
        //Chargement des articles IMMEDIATS dans le panier
        $articlesImmediatPanier = requeteSqlArray("SELECT * from article a, articleimmediat ai, articleInPanier ap where a.idArticle = ai.idArticle and a.idArticle = ap.articleId and (ap.utilisateurId = '{$_SESSION['idUtilisateur']}')",$pdo);

        //Création de ligne dans articleLog pour tous les articles immédiats
        foreach($articlesImmediatPanier as $a){
            requeteSqlArray("INSERT INTO articlelog (prixAchat,articleId,commandeLogId) values ('{$a['prixActuel']}','{$a['articleId']}','{$idCommandeLog[0]['LAST_INSERT_ID()']}');",$pdo);
        }

        requeteSqlArray("DELETE FROM articleInPanier where utilisateurId ='{$_SESSION["idUtilisateur"]}' ",$pdo);

      


    }

    //Redirection vers l'historique des commandes
    header('Location: ../index.php?page=panier/panier&alerts=1&tA=payer&valA=rien');
    exit();
 ?>