<?php
include('../../bdd/donneeSession.php');
include('../../bdd/connectBDD.php');
if(LOGGED){
    if($_SESSION['estAdmin']){
        if(isset($_POST['submit'])){
            $allUsers= $articlesAVendreImm= requeteSqlArray("SELECT * from utilisateur", $pdo);
            

            foreach($allUsers as $user){
                if(isset($_POST['estVendeurModif'.$user['idUtilisateur']])){ //Si coché dans la page
                    if($user['estVendeur']!=1){ //Si pas déjà admin

                        $vendeurTable=requeteSqlArray("SELECT * from vendeur where utilisateurId = {$user['idUtilisateur']}",$pdo);

                        if(sizeof($vendeurTable)==0){ //Pas dans la table vendeur
                            //On l'ajoute dans la table vendeur
                            requeteSqlArray("INSERT INTO vendeur (utilisateurId) values ({$user['idUtilisateur']})",$pdo);

                            
                        }
                       
                        //On recheck la table vendeur
                        $vendeurTable=requeteSqlArray("SELECT * from vendeur where utilisateurId = {$user['idUtilisateur']}",$pdo);
                        var_dump( $vendeurTable);
                        
                        //Modification de utilisateur
                        requeteSqlArray("UPDATE utilisateur set estVendeur = 1, vendeurId = {$vendeurTable[0]['idVendeur']}  where idUtilisateur = {$user['idUtilisateur']}",$pdo);
                    }

                }
                else{ //Si pas coché
                    //Modification de utilisateur
                    requeteSqlArray("UPDATE utilisateur set estVendeur = 0 where idUtilisateur = {$user['idUtilisateur']}",$pdo);
                }
            }

            header('Location: ../../index.php?page=admin&alerts=1&tA=modifVendeurAdmin&valA=&affichage=1');
            exit();

            
            
        }else{
            header('Location: ../../index.php');
            exit();
        }
        
       

    }else{
        header('Location: ../../index.php');
        exit();
    }
}
else{
    header('Location: ../../index.php');
    exit();
}
   
    
?>