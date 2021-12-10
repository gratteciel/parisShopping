<?php
    include('../../bdd/donneeSession.php');
    include('../../bdd/connectBDD.php');
    date_default_timezone_set('Europe/Paris');
    $date = date('Y-m-d H:i:s', time());

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


    $alertList = requeteSqlArray("SELECT * from alertestock Where idArticle = '{$_REQUEST['idArticle']}' ", $pdo);
 foreach ($alertList as $alertInfo){
     requeteSqlArray("INSERT INTO `notification` (`idNotification`, `nom`, `description`, `date`,`idUtilisateur`,`idArticle`  ) VALUES (NULL,'{$nom}','{$description}','{$date}', '{$alertInfo['idUtilisateur']}','{$_REQUEST["idArticle"]}')",$pdo);

 }
header('Location: ../../index.php?page=article&id='.$_REQUEST["idArticle"]);
exit();

