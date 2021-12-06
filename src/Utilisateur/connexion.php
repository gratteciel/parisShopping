<?php
    $user =isset($_REQUEST["pseudo"])? $_REQUEST['pseudo'] : NULL;
    $displayNoCompte="none";

    //Connection à la BDD
    include('../bdd/connectBDD.php');
    include('../bdd/donneeSession.php'); 

    //Déclaration des variables
    $emailOuPseudo = isset($_POST["mail"])? $_POST["mail"] : "";
    $mdp = isset($_POST["mdp"])? $_POST["mdp"] : "";
    

    if(isset($_POST["submit"])){ //Si il y a eu une requete de connection avec le form
        $resultat = requeteSqlArray("SELECT * from utilisateur where (mail like '{$emailOuPseudo}' OR pseudo like '{$emailOuPseudo}') AND mdp =password('{$mdp}')",$pdo);
       
        if(sizeof($resultat)==1){
            $_SESSION['LOGGED'] = true;
            $_SESSION['idUtilisateur'] = $resultat[0]['idUtilisateur'];
            $_SESSION['pseudo'] = $resultat[0]['pseudo'];
            $_SESSION['mail'] = $resultat[0]['mail'];
            $_SESSION['estAdmin'] = $resultat[0]['estAdmin'];
            $_SESSION['prenom'] = $resultat[0]['prenom'];
            $_SESSION['nom'] = $resultat[0]['nom'];
            $_SESSION['numTel'] = $resultat[0]['numTel'];

            header('Location: ../index.php?connexion=' . $resultat[0]['pseudo']);
            exit();
        }
        else{
            $displayNoCompte="visible";
        }

        
    }

  
?>

<!DOCTYPE html>
<html>
    <head>
        <!-- Include du CSS Bootstrap -->
        <link href="../../assets/dist/css/bootstrap.min.css" rel="stylesheet">
        <link rel="canonical" href="https://getbootstrap.com/docs/5.1/examples/pricing/">
        <link rel="stylesheet" type="text/css" href="../css/main.css">
        <link rel="stylesheet" type="text/css" href="../css/connexion.css">
        <title>Connexion - Paris Shopping</title>
    </head>
    <body class="text-light" >
        <?php if($user) : ?>
            <div class="alert alert-success text-center" role="alert">
                Bravo  <?php echo $user ?>, vous avez bien créé votre compte! <br>
                Maintenant, connectez vous :
            </div>
        <?php endif; ?>
        <div class="center " style="height:90%;">
                <a href="../view/page/accueil.php">
                    <img src="../../images/logo.png" style="width:150px;" alt="Logo">
                </a>
                <div style="margin-top:2%;max-width:400px;">
                <?php if($_SESSION['LOGGED']) : ?>


                   <p>Vous etes connecté avec le pseudo : <?php echo $_SESSION['pseudo'] ?></p> 
                   <form action="deconnexion.php" method="post">
                    
                    <div class="center">
                        <button class="btn btn-primary form-connexion" type="submit" name="submitDeconnection" style="width:50%;margin-top:15px;">Se déconnecter</button>
                    </div>
                
                    </form>
                <?php else : ?>
                    <form action="" method="post">
                    
                        <div class="form-connexion">
                            <label for="mail" class="form-label">Mail ou Pseudo</label>
                            <input type="text" class="form-control" id="mail" name="mail" placeholder="test@exemple.com ou pseudo" required>
                                <div class="text-danger" style="display:none;">
                                    Veuillez renseigner votre mail
                                </div>
                        </div>
                        
                        <div class="form-connexion">
                            <label for="mdp" class="form-label">Mot de passe</label>
                            <input type="password" class="form-control" id="mdp" name="mdp" required>
                            <div class="text-danger" style="display:none;">
                                Veuillez renseigner votre mot de passe
                            </div>
                        </div>
                        
                        
                        <div class="center">
                            <button class="btn btn-primary form-connexion" type="submit" name="submit" style="width:50%;margin-top:15px;">Se connecter</button>
                            <div class="text-danger" style="display:<?php echo $displayNoCompte ?>;">
                            Il n'existe aucun compte avec ce pseudo/mail et ce mot de passe
                        </div>
                        </div>

                        <div style="display:flex;justify-content: center;">
                            <p class="text-center mt-2" style="width:80%;align-items:center">En passant une commande, vous acceptez les Conditions générales de ventes</p>
                        </div>
                    
                    </form>
                <?php endif; ?>
                </div>
            </div>
            <?php if(!$_SESSION['LOGGED']) : ?>
            <p class="text-center">Vous n'avez pas encore de compte? <br> <a href="inscription.php">Cliquez-ici</a></p>
            <?php endif; ?>
        
        <script src="../../../assets/dist/js/bootstrap.bundle.min.js"></script>

    
    </body>
    
</html>