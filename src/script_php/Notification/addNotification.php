<?php
    include('../../bdd/connectBDD.php');
    date_default_timezone_set('Europe/Paris');
    $date = date('Y-m-d H:i:s', time());
    $nom =
requeteSqlArray("INSERT INTO `articleinpanier` (`idNotification`, `nom`, `description`, `date`,`idUtilisateur`,`idArticle`  ) VALUES (NULL, ,'{$date}', '{$_REQUEST["idArticle"]}', '{$_REQUEST["idUtilisateur"]}')",$pdo);
