<?php 
    include('../../bdd/donneeSession.php');
    include('../../bdd/connectBDD.php');
    $erreur=0;
    $message="";





    if(isset($_POST['submit'])){






        if(isset($_POST['prix']))
        {
            if(isset($_REQUEST['idArtEnchere'])){

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
                    header('Location: ../../index.php?page=article&id=' . $_REQUEST["idArticle"].'&err=codeSecuPasBon&val='.substr($resultat[0]['numeroCarte'], -4));
                    exit();
                }

                 //Check de la date d'expiration de la carte bleu
                $paiement = requeteSqlArray("SELECT * from paiement where idPaiement = '{$_POST["paiementPayer"]}' and utilisateurId = '{$_SESSION['idUtilisateur']}'",$pdo);

                date_default_timezone_set('Europe/Paris');
                $dateJour = date('Y-m-d', time());
                if($dateJour >= $paiement[0]['dateExpiration']){
                    header('Location: ../../index.php?page=article&id=' . $_REQUEST["idArticle"].'&err=dateExpiration&val='.$paiement[0]['dateExpiration']);
                    exit();
                }
                
                $articleEnchere = requeteSqlArray("SELECT * from articleenchere where idArticleEnchere = '{$_REQUEST['idArtEnchere']}'",$pdo);
                $encherePrixMax = requeteSqlArray("SELECT MAX(prixMax),idUtilisateur from enchere where idArticleEnchere = '{$_REQUEST['idArtEnchere']}'",$pdo);
                
                if($encherePrixMax[0]['MAX(prixMax)']!=null){
                  
                    if($_POST['prix']<= $encherePrixMax[0]['MAX(prixMax)']){
                        $erreur++;
                        $message="Votre prix doit être strictement supérieur que la meilleure offre actuelle";
                        
                    }
                }
                else{
                    if($_POST['prix']<= $articleEnchere[0]['prixDepart']){
                        $erreur++;
                        $message="Votre prix doit être strictement supérieur au prix de départ de l'enchère";
                        
                    }
                }
                if($erreur==0){ //Si tout est bon
                    //Création de paiementLog
                    requeteSqlArray("INSERT INTO paiementLog (typeCarte,numeroCarte,nomCarte,codeSecurite,dateExpiration)  values ('{$paiement[0]['typeCarte']}','{$paiement[0]['numeroCarte']}','{$paiement[0]['nomCarte']}','{$paiement[0]['codeSecurite']}','{$paiement[0]['dateExpiration']}');",$pdo);
                    $idPaiementLog=requeteSqlArray("SELECT LAST_INSERT_ID();",$pdo);
                    

                    //Création de adresseLog
                    $adresse = requeteSqlArray("SELECT * from adresse where idAdresse = '{$_POST["adressePayer"]}' and utilisateurId = '{$_SESSION['idUtilisateur']}'",$pdo);
                    requeteSqlArray("INSERT INTO adresseLog (numeroVoie,rue,ville,codePostal,nom,pays) values ('{$adresse[0]['numeroVoie']}','{$adresse[0]['rue']}','{$adresse[0]['ville']}','{$adresse[0]['codePostal']}','{$adresse[0]['nom']}','{$adresse[0]['pays']}');",$pdo);
                    $idAdresseLog=requeteSqlArray("SELECT LAST_INSERT_ID();",$pdo);

                    date_default_timezone_set('Europe/Paris');
                    $date = date('Y-m-d H:i:s', time());
                    
                    

                    //Création de la ligne enchere
                    requeteSqlArray("INSERT INTO `enchere` (`prixMax`, `idUtilisateur`, `idArticleEnchere`,idAdresseLog,idPaiementLog) VALUES ('{$_POST['prix']}', '{$_SESSION['idUtilisateur']}','{$_REQUEST['idArtEnchere']}','{$idAdresseLog[0]['LAST_INSERT_ID()']}','{$idPaiementLog[0]['LAST_INSERT_ID()']}')",$pdo);
                    
                  
                    date_default_timezone_set('Europe/Paris');
                    $date = date('Y-m-d H:i:s', time());
                    //Création d'une notification
                    requeteSqlArray("INSERT INTO notification (nom,descriptionNotif,dateNotif,idUtilisateur,vu,lien) values ('Ajout meilleure offre','Vous avez bien proposé une meilleure offre pour cet article','{$date}','{$_SESSION['idUtilisateur']}',0,'article&id={$_REQUEST["idArticle"]}');",$pdo);

                    header('Location: ../../index.php?page=article&id=' . $_REQUEST["idArticle"] . "&alerts=1&tA=addEnchere&valA=");
                    exit();
                }
                else{
                    header('Location: ../../index.php?page=article&id=' . $_REQUEST["idArticle"] ."&err=1&val=".$message);
                    exit();
                }
                
                
            }
            
        }
        
       
    }
   
    


?>