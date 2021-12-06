<?php 
      include('../bdd/donneeSession.php'); 
       //Si appuie sur bouton de déconnection
        $_SESSION['LOGGED'] = false;
        $_SESSION['idUtilisateur'] = NULL;
        $_SESSION['pseudo'] = NULL;
        $_SESSION['mail'] = NULL;
        $_SESSION['estAdmin'] = NULL;
        $_SESSION['prenom'] = NULL;
        $_SESSION['nom'] = NULL;
        $_SESSION['numTel'] = NULL;
        
        header('Location: ../accueil.php');
        exit();

?>