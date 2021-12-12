<?php
include('../bdd/donneeSession.php');
include('../bdd/connectBDD.php');
requeteSqlArray(" UPDATE utilisateur SET {$_REQUEST=["estVendeur"]} WHERE idUtilisateur={$_REQUEST["idUtilisateur"]} ",$pdo);
header('Location: ../index.php?page=administrateur&alerts=1&tA=supprVendeur&valA=rien');
exit();