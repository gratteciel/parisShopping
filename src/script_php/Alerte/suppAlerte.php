<?php
    include('../../bdd/donneeSession.php');
    include('../../bdd/connectBDD.php');
    requeteSqlArray("DELETE FROM `alertestock` where idArticle = '{$_REQUEST["idArticle"]}' and idUtilisateur ='{$_SESSION["idUtilisateur"]}' ",$pdo);
    header('Location: ../../index.php?page=article&id=' . $_REQUEST["idArticle"] . "&alerts=1&tA=suppAlerte&valA=" . $_REQUEST["nom"]);
    exit();
?>