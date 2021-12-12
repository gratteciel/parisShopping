<?php 
    include('../../bdd/donneeSession.php');
    include('../../bdd/connectBDD.php');

    if(LOGGED){
        if($_SESSION['estVendeur']){
            
            $negociationATraiter = requeteSqlArray("SELECT * from negociation where idArticleNegociation='{$_REQUEST['idArticleNegociation']}' and traiter=0",$pdo);

            foreach($negociationATraiter as $n){
                $val = "submit".$n['idNegociation'];
                $erreur=0;
                if(isset($_POST[$val])){

                    
                    
                    $valType="type".$n['idNegociation'];
                    $contreOffre="contreOffre".$n['idNegociation'];
                    $valContreOffre=$_POST[$contreOffre];
                    
                    if($_POST[$valType]==1){
                        if($_POST[$contreOffre]='' ){
                            $erreur++;
                        }
                        if(!is_numeric($valContreOffre)){
                            $erreur++;
                        }
                        
                       
                            
                        
                    }
                   
                    if($erreur==0){
                        date_default_timezone_set('Europe/Paris');
                        $date = date('Y-m-d H:i:s', time());
                        if($_POST[$valType]==1){ //Contre offre
                            
                            requeteSqlArray("UPDATE negociation set traiter = 1, accepted=0, contreOffre = '{$valContreOffre}' where idNegociation={$n['idNegociation']} ",$pdo);
                        
                            //Création d'une notification pour l'acheteur
                            requeteSqlArray("INSERT INTO notification (nom,descriptionNotif,dateNotif,idUtilisateur,vu,lien) values ('Négociation','Le vendeur n\'accepte pas votre prix pour la négociation de l\'article (me cliquer)','{$date}','{$n['idUtilisateur']}',0,'article&id={$_REQUEST["idArticle"]}');",$pdo);

                        }
                        else if($_POST[$valType]==2){//Accepted
                            
                            requeteSqlArray("UPDATE negociation set traiter = 1, accepted=1 where idNegociation={$n['idNegociation']} ",$pdo);
                            
                           
                            //Création de commandeLog pour l'user qui a gagné
                            requeteSqlArray("INSERT INTO commandeLog (dateCommande,utilisateurId,idAdresseLog,idPaiementLog) values ('{$date}','{$n['idUtilisateur']}','{$n['idAdresseLog']}','{$n['idPaiementLog']}');",$pdo);
                            $idCommandeLog=requeteSqlArray("SELECT LAST_INSERT_ID();",$pdo);
                            
                            

                            //Ajout de idCommandeLog dans paimentLog et adresseLog
                            requeteSqlArray("UPDATE paiementLog SET idCommandeLog='{$idCommandeLog[0]['LAST_INSERT_ID()']}' where idPaiementLog = '{$n['idPaiementLog']}'",$pdo);
                            requeteSqlArray("UPDATE adresseLog SET idCommandeLog='{$idCommandeLog[0]['LAST_INSERT_ID()']}' where idAdresseLog = '{$n['idAdresseLog']}'",$pdo);
                            
                            

                            //ArticleLog
                            requeteSqlArray("INSERT INTO articlelog (prixAchat,articleId,commandeLogId) values ('{$n['prixUser']}','{$_REQUEST['idArticle']}','{$idCommandeLog[0]['LAST_INSERT_ID()']}');",$pdo);

                            //Création d'une notification pour l'acheteur
                            requeteSqlArray("INSERT INTO notification (nom,descriptionNotif,dateNotif,idUtilisateur,vu,lien) values ('Négociation','Le vendeur a accepté votre prix pour la négociation de l\'article, cliquez pour l\'afficher dans vos commandes','{$date}','{$n['idUtilisateur']}',0,'commande&id={$idCommandeLog[0]['LAST_INSERT_ID()']}');",$pdo);

                            //On traite tous les autres sans les accepter
                            foreach($negociationATraiter as $b){
                                requeteSqlArray("UPDATE negociation set traiter = 1, accepted=0 where idNegociation={$b['idNegociation']} ",$pdo);
                            }
                            
                            requeteSqlArray("UPDATE articlenegociation set fini = 1 where idArticleNegociation='{$_REQUEST['idArticleNegociation']}'",$pdo);

                            

                        }
                        
                        header('Location: ../../index.php?page=article&id='.$_REQUEST['idArticle'].'&alerts=1&tA=gestionNegoc&valA=rien');
                        exit();
                    }
                    else{
                        header('Location: ../../index.php?page=article&id='.$_REQUEST['idArticle'].'&alerts=1&tA=gestionNegocFail&valA=rien');
                        exit();
                    }
                    
                    
                    
                }
            }
   
        }
    }

    

?>