<?php
include('../../bdd/donneeSession.php');
include('../../bdd/connectBDD.php');

$article = requeteSqlArray("SELECT * from article Where idArticle = '{$_REQUEST['idArticle']}'",$pdo);
requeteSqlArray("UPDATE article SET quantite = quantite+1  Where idArticle = '{$_REQUEST['idArticle']}'", $pdo);

if($article[0]['quantite'] == 0) {
    header('Location: ../Notification/addNotification.php?idArticle='. $_REQUEST['idArticle']."&nom=" .$_REQUEST['nom']."&disponible=1");
}
else{
    header('Location: ../../index.php?page=article&id='.$_REQUEST["idArticle"]);
}

exit();
