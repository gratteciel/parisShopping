<?php 
      include('../../bdd/donneeSession.php'); 
       //Si appuie sur bouton de déconnection
       $pseudo = $_SESSION['pseudo'] ;
        $_SESSION['LOGGED'] = false;
        $_SESSION['idUtilisateur'] = NULL;
        $_SESSION['pseudo'] = NULL;
        $_SESSION['mail'] = NULL;
        $_SESSION['estAdmin'] = NULL;
        $_SESSION['prenom'] = NULL;
        $_SESSION['nom'] = NULL;
        $_SESSION['numTel'] = NULL;
        
        header('Location: ../../index.php?alerts=1&tA=deconnect&valA='.$pseudo);
        exit();

?>