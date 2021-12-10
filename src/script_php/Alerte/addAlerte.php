<?php
    include('../../bdd/donneeSession.php');
    include('../../bdd/connectBDD.php');
    requeteSqlArray("INSERT INTO `alertestock` (`IdAlerte`, `idArticle`, `idUtilisateur`) VALUES (NULL, '{$_REQUEST["idArticle"]}', '{$_SESSION["idUtilisateur"]}')", $pdo);
    header('Location: ../../index.php?page=article&id=' . $_REQUEST["idArticle"] . "&alerts=1&tA=addAlerte&valA=" . $_REQUEST["nom"]);
    exit();
?>