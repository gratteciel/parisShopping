<?php
include_once __DIR__ . '/../bdd/donneeSession.php';
include_once __DIR__ . '/../../config/config.php';
include_once __DIR__ . '/../bdd/connectBDD.php';

//Si appuie sur bouton de déconnection
$pseudo = $_SESSION['pseudo'];
unset(
    $_SESSION['LOGGED'],
    $_SESSION['idUtilisateur'],
    $_SESSION['pseudo'],
    $_SESSION['mail'],
    $_SESSION['estAdmin'],
    $_SESSION['prenom'],
    $_SESSION['nom'],
    $_SESSION['numTel']
);
//        $_SESSION['LOGGED'] = false;
//        $_SESSION['idUtilisateur'] = NULL;
//        $_SESSION['pseudo'] = NULL;
//        $_SESSION['mail'] = NULL;
//        $_SESSION['estAdmin'] = NULL;
//        $_SESSION['prenom'] = NULL;
//        $_SESSION['nom'] = NULL;
//        $_SESSION['numTel'] = NULL;

header('Location: ../index.php?deconnexion=' . $pseudo);
exit();
