<?php
// default - user not logged
$idUtilisateur = null;
if (!empty($_SESSION['LOGGED']) && !empty($_SESSION['idUtilisateur'])) {
    $idUtilisateur = $_SESSION['idUtilisateur'];
}
