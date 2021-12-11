<?php

    $header="MIME-Version: 1.0\r\n";
    $header.='From:"ParisShopping"<parisshopingece@gmail.com>'."\n";
    $header.='Content-Type:text/html; charset="uft-8"'."\n";
    $header.='Content-Transfer-Encoding: 8bit';




    include('../../bdd/donneeSession.php');
    include('../../bdd/connectBDD.php');
    date_default_timezone_set('Europe/Paris');
    $date = date('Y-m-d H:i:s', time());

    var_dump($_REQUEST);
    $nom = "";
    $description ="";

    if ($_REQUEST['disponible']==1){
     $nom = 'Disponible';
    $description = $_REQUEST['nom']." est enfin disponible";
    }
    elseif ($_REQUEST['disponible']==0){
        $nom = "Rupture";
        $description = $_REQUEST['nom']." est en rupture de stock";
    }
    //pour structurer un mail

$message='<html>
        <body>
            <div align="center">
                '.$description.'
            </div>
        </body>
    </html>
    ';

    //

    $alertList = requeteSqlArray("SELECT * from alertestock Where idArticle = '{$_REQUEST['idArticle']}' ", $pdo);
    foreach ($alertList as $alertInfo){
        requeteSqlArray("INSERT INTO notification (nom,descriptionNotif,dateNotif,idUtilisateur,lien) VALUES ('{$nom}','{$description}','{$date}', '{$alertInfo['idUtilisateur']}','article&id={$_REQUEST['idArticle']}');",$pdo);

        //pour envoyer un mail
        $utilisateur = requeteSqlArray("SELECT * from utilisateur where idUtilisateur = '{$alertInfo['idUtilisateur']}'", $pdo);
        mail($utilisateur[0]['mail'],$nom,$message,$header);
        //

    }






header('Location: ../../index.php?page=article&id='.$_REQUEST["idArticle"]);


exit();

