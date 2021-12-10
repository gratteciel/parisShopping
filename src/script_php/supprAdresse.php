<?php  
    include('../bdd/donneeSession.php');
    include('../bdd/connectBDD.php');
    requeteSqlArray("DELETE FROM adresse where idAdresse = '{$_REQUEST["idAdresse"]}' and utilisateurId ='{$_SESSION["idUtilisateur"]}' ",$pdo);
    header('Location: ../index.php?page=votre_compte&alerts=1&tA=supprAdresse&valA=rien');
    exit();
 ?>