<?php 
    include('../../bdd/donneeSession.php');
    include('../../bdd/connectBDD.php');
    $erreur=0;
    $message="";





    if(isset($_POST['submit'])){


        


        if(isset($_POST['prix']))
        {
            
            if(isset($_REQUEST['idArtNegociation'])){
                
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
                
                


                $articleNegociation = requeteSqlArray("SELECT * from articlenegociation where idArticleNegociation= '{$_REQUEST['idArtNegociation']}'",$pdo);
                
                if(sizeof($articleNegociation)==0)
                    $erreur++;
                
                
              
                
            
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
                    
                  
                    //Création de la ligne negociation
                    requeteSqlArray("INSERT INTO `negociation` (`prixUser`, `idUtilisateur`, `idArticleNegociation`,idAdresseLog,idPaiementLog,dateNegocUser) VALUES ('{$_POST['prix']}', '{$_SESSION['idUtilisateur']}','{$_REQUEST['idArtNegociation']}','{$idAdresseLog[0]['LAST_INSERT_ID()']}','{$idPaiementLog[0]['LAST_INSERT_ID()']}','{$date}')",$pdo);
                    
                  
                    


                
                    //Création d'une notification pour l'acheteur
                    requeteSqlArray("INSERT INTO notification (nom,descriptionNotif,dateNotif,idUtilisateur,vu,lien) values ('Vous avez négocié un article','Vous avez bien proposé une négociation avec le vendeur pour un article (me cliquer)','{$date}','{$_SESSION['idUtilisateur']}',0,'article&id={$_REQUEST["idArticle"]}');",$pdo);

                    //Trouver l'id du vendeur
                $idUserVendeur = requeteSqlArray("SELECT * from article a, vendeur v where a.idArticle= {$_REQUEST["idArticle"]} and a.vendeurId= v.idVendeur ",$pdo);
                var_dump($idUserVendeur);
                   

                    //Création d'une notification pour le vendeur
                    requeteSqlArray("INSERT INTO notification (nom,descriptionNotif,dateNotif,idUtilisateur,vu,lien) values ('Concernant votre article en négociation','Une personne a proposé un prix pour votre article : {$idUserVendeur[0]['nom']}','{$date}','{$idUserVendeur[0]['utilisateurId']}',0,'article&id={$_REQUEST["idArticle"]}');",$pdo);


                    

                    header('Location: ../../index.php?page=article&id=' . $_REQUEST["idArticle"] . "&alerts=1&tA=addNegociation&valA=");
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