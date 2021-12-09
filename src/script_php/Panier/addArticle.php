<?php  
    include('../../bdd/donneeSession.php');
    include('../../bdd/connectBDD.php');
    date_default_timezone_set('Europe/Paris');
    $date = date('Y-m-d H:i:s', time());
    requeteSqlArray("INSERT INTO `articleinpanier` (`idArticleInPanier`, `dateAJout`, `articleId`, `utilisateurId`) VALUES (NULL, '{$date}', '{$_REQUEST["idArticle"]}', '{$_SESSION['idUtilisateur']}')",$pdo);
    header('Location: ../../index.php?page=article&id='.$_REQUEST["idArticle"]."&alerts=1&tA=addA&valA=".$_REQUEST["nom"]);
    exit();
 ?>