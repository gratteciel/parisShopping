<?php  
    include('../bdd/donneeSession.php');
    include('../bdd/connectBDD.php');
    requeteSqlArray("DELETE FROM paiement where idPaiement = '{$_REQUEST["idPaiement"]}' and utilisateurId ='{$_SESSION["idUtilisateur"]}' ",$pdo);
    header('Location: ../index.php?page=votre_compte&alerts=1&tA=supprPaiement&valA=rien');
    exit();
 ?>