<?php 
  include('../../bdd/donneeSession.php');
  include('../../bdd/connectBDD.php');
  date_default_timezone_set('Europe/Paris');
  $date = date('Y-m-d H:i:s', time());
     if(LOGGED){
             if($_SESSION['estAdmin']){
              
                 
                 //Toutes les enchères qui ont une date de fin inférieur à celle actuelle 
                 // (quand il faut s'en occuper et désigner qui a la meilleure offre)
                 $articleEnchereASoccuper=requeteSqlArray("SELECT * from articleenchere where fini=0 and dateFin< NOW() ", $pdo);
                
     
                 foreach($articleEnchereASoccuper as $a){
     
                     $result = requeteSqlArray("SELECT * from enchere where idArticleEnchere = {$a['idArticleEnchere']} ORDER BY prixMax DESC", $pdo);
     
                     $winner=null;
                     $userWinner=null;
                     if(isset($result[0])){
                         $winner=$result[0];
                         $idUtilisateurWinner=$winner['idUtilisateur'];
                         $userWinner = requeteSqlArray("SELECT * from utilisateur where idUtilisateur = {$idUtilisateurWinner} ", $pdo);
                        
                     }
                         
                     
                     
     
                     $prixDeuxieme=null;
                     if(isset($result[1]))
                         $prixDeuxieme=$result[1];
                     
                    //Mettre l'enchère fini:
                    requeteSqlArray("UPDATE articleenchere set fini=1 where idArticleEnchere= {$a['idArticleEnchere']}", $pdo);

                     if($winner!=null){ //Si il y a une meilleure offre

                        

                      

                        $prixAPayer=1;
                        if($prixDeuxieme!=null){
                            $prixAPayer=$prixDeuxieme['prixMax']+1;
                        }

                       
                        
                       
                        //Création de commandeLog pour l'user qui a gagné
                        requeteSqlArray("INSERT INTO commandeLog (dateCommande,utilisateurId,idAdresseLog,idPaiementLog) values ('{$date}','{$userWinner[0]['idUtilisateur']}','{$winner['idAdresseLog']}','{$winner['idPaiementLog']}');",$pdo);
                        $idCommandeLog=requeteSqlArray("SELECT LAST_INSERT_ID();",$pdo);
                        
                        

                        //Ajout de idCommandeLog dans paimentLog et adresseLog
                        requeteSqlArray("UPDATE paiementLog SET idCommandeLog='{$idCommandeLog[0]['LAST_INSERT_ID()']}' where idPaiementLog = '{$winner['idPaiementLog']}'",$pdo);
                        requeteSqlArray("UPDATE adresseLog SET idCommandeLog='{$idCommandeLog[0]['LAST_INSERT_ID()']}' where idAdresseLog = '{$winner['idAdresseLog']}'",$pdo);
                        
                        

                        //ArticleLog
                        requeteSqlArray("INSERT INTO articlelog (prixAchat,articleId,commandeLogId) values ('{$prixAPayer}','{$a['idArticle']}','{$idCommandeLog[0]['LAST_INSERT_ID()']}');",$pdo);
                        
                        $article = requeteSqlArray("SELECT * from article where idArticle = {$a['idArticle']}", $pdo);


                        //Création d'une notification
                        requeteSqlArray("INSERT INTO notification (nom,descriptionNotif,dateNotif,idUtilisateur,vu,lien) values ('Commande - Meilleure offre','Vous avez eu la meilleure offre ({$article[0]['nom']}) pour seulement {$prixAPayer}€','{$date}','{$userWinner[0]['idUtilisateur']}',0,'commande&id={$idCommandeLog[0]['LAST_INSERT_ID()']}');",$pdo);
                        
                       

                     }
                     
                     
                     
                 }
                 header('Location: ../../index.php?page=admin&alerts=1&tA=acceptEnchere&valA=');
                 exit();
             }
             else{
                header('Location: ../../index.php');
                exit();
             }
         }else{header('Location: ../../index.php');
            exit();}


?>