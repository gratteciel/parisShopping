<?php
 
 
    function checkQuantiteNotification($idArticle,$nomArticle,$quantite,$oldQuantite,$pdo){
        $nom = "";
        $description ="";

        if($quantite <= 0) {
            $nom = 'Rupture';
            $description = $nomArticle." est en rupture de stock";
        }
        else if($oldQuantite<=0 && $quantite >0) {
            $nom = "Disponible";
            $description = $nomArticle." est enfin disponible";
        }

        if($nom!=""){
            date_default_timezone_set('Europe/Paris');
            $date = date('Y-m-d H:i:s', time());
            $alertList = requeteSqlArray("SELECT * from alertestock Where idArticle = '{$idArticle}' ", $pdo);
            foreach ($alertList as $alertInfo){
                requeteSqlArray("INSERT INTO notification (nom,descriptionNotif,dateNotif,idUtilisateur,lien) VALUES ('Alerte stock - {$nom} ','{$description}','{$date}', '{$alertInfo['idUtilisateur']}','article&id={$idArticle}');",$pdo);

            }
        }

        
    }

    

?>