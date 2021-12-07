<?php  
    include('../../bdd/connectBDD.php');
    requeteSqlArray("DELETE FROM articleinpanier where articleId = '{$_REQUEST["idArticle"]}' and idArticleInPanier='{$_REQUEST["idPanier"]}' and utilisateurId ='{$_REQUEST["idUtil"]}' ",$pdo);
    header('Location: ../../index.php?page=panier/panier&alerts=1&tA=supprA&valA='.$_REQUEST["nom"]);
    exit();
 ?>