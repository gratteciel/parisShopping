<?php
include_once __DIR__ . '/../bdd/donneeSession.php';
include_once __DIR__ . '/../../config/config.php';
include_once __DIR__ . '/../bdd/connectBDD.php';

    $displayErreur="none";
    $messageErreur="Il y a eu une erreur dans votre formulaire!";
   
    //Déclaration des variables
    $email = isset($_POST["mail"])? $_POST["mail"] : "";
    $pseudo = isset($_POST["pseudo"])? $_POST["pseudo"] : "";
    $nom = isset($_POST["nom"])? $_POST["nom"] : "";
    $prenom = isset($_POST["prenom"])? $_POST["prenom"] : "";
    $numTel = isset($_POST["numTel"])? $_POST["numTel"] : "";
    $mdp = isset($_POST["mdp"])? $_POST["mdp"] : "";
    
    $erreur=0;

    if(isset($_POST["submit"])){ //Si il y a eu une requete de connection avec le form
        //$resultat = requeteSqlArray("SELECT * from utilisateur where (mail like '{$emailOuPseudo}' OR pseudo like '{$emailOuPseudo}') AND mdp =password('{$mdp}')",$pdo);
        //blindage coté serveur:

        //Vérification du mail
        if(!filter_var($email, FILTER_VALIDATE_EMAIL)) {
           $erreur++;
        }

        //Vérification du pseudo
        $pseudoArray = str_split($pseudo);
        foreach($pseudoArray as $character){
            if($character==' ')
                $erreur++;
        }

        $tailleMdp = strlen($mdp);
        if($tailleMdp<8)
            $erreur++;
        
        


        //Vérification si existe deja
        $result = requeteSqlArray("SELECT mail from utilisateur where mail like '{$email}'",$pdo);

        if(sizeof($result)>0){
            $erreur=10000;
            $messageErreur = "Ce mail est deja enregistré sur notre site";
        }

        $result2 = requeteSqlArray("SELECT pseudo from utilisateur where pseudo like '{$pseudo}' or pseudo like '{$pseudo}'",$pdo);

        if(sizeof($result2)>0){
            if($erreur==10000){
                $messageErreur = "Ce mail et ce pseudo sont deja enregistrés sur notre site";
            }
            else
            $messageErreur = "Ce pseudo est deja enregistré sur notre site";
            $erreur++;
        }
        
        if($erreur!=0)
            $displayErreur="visible";    
        else
        {
            requeteSqlArray("INSERT INTO Utilisateur (prenom, nom, mail, mdp, estAdmin, pseudo, numTel) VALUES('{$prenom}', '{$nom}','{$email}',password('{$mdp}'),0,'{$pseudo}','{$numTel}');",$pdo);
           
            header('Location: connexion.php?pseudo='.$pseudo);
            exit();
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
        <title>Inscription - Paris Shopping</title>
    </head>
    <body class="text-light" >
        <div class="center " style="height:90%;">
                <a href="../index.php">
                    <img src="../../images/logo.png" style="width:150px;" alt="Logo">
                </a>
                <div style="max-width:450px;">
                <?php if(LOGGED) : ?>


                   <p>Vous etes connecté avec le pseudo : <?php echo $_SESSION['pseudo'] ?></p> 
                   <form action="deconnexion.php" method="post">
                    
                    <div class="center">
                        <button class="btn btn-primary form-connexion" type="submit" name="submitDeconnection" style="width:50%;margin-top:15px;">Se déconnecter</button>
                    </div>
                
                    </form>
                <?php else : ?>
                    <form action="" method="post">
                        <div class="row">
                            <div class="form-connexion col-7">
                                <label for="mail" class="form-label">Mail*</label>
                                <input type="text" class="form-control" id="mail" name="mail" placeholder="test@exemple.com" required>
                                    <div class="text-danger" style="display:none;">
                                        Veuillez renseigner votre mail
                                    </div>
                            </div>
                           
                            <div class="form-connexion col">
                                <label for="mail" class="form-label">Pseudo*</label>
                                <input type="text" class="form-control" id="pseudo" name="pseudo" placeholder="Pas d'espace!" required>
                                    <div class="text-danger" style="display:none;">
                                        Veuillez renseigner votre pseudo
                                    </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="form-connexion col">
                                <label for="prenom" class="form-label">Prenom*</label>
                                <input type="text" class="form-control" id="prenom" name="prenom" placeholder="Michael" required>
                            </div>
                           
                            <div class="form-connexion col">
                                <label for="nom" class="form-label">Nom*</label>
                                <input type="text" class="form-control" id="nom" name="nom" placeholder="Jackson" required>
                            </div>
                        </div>
                        
                        <div class="form-connexion col">
                                <label for="mdp" class="form-label">Numéro de téléphone</label>
                                <input type="text" class="form-control" id="numTel" name="numTel" placeholder="Non obligatoire" >
                                
                        </div>

                        <div class="form-connexion col">
                            <label for="mdp" class="form-label">Mot de passe* (minimum 8 caractères)</label>
                            <input type="password" class="form-control" id="mdp" name="mdp" required>
                            <div class="text-danger" style="display:none;" >
                                Veuillez renseigner votre mot de passe
                            </div>
                        </div>
                        
                            
                            <div class="center">
                                <button class="btn btn-primary form-connexion" type="submit" name="submit" style="width:30%;margin-top:15px;">Inscription</button>
                                <div class="text-danger" style="display:<?php echo $displayErreur ?>;">
                                <?php echo $messageErreur ?>
                            </div>
                            </div>

                            <div style="display:flex;justify-content: center;">
                                <p class="text-center mt-2" style="width:80%;align-items:center">En créant un compte, vous acceptez les Conditions générale de vente</p>
                            </div>
                        
                    </form>
                <?php endif; ?>
                </div>
            </div>

        
        <script src="../../../assets/dist/js/bootstrap.bundle.min.js"></script>

    
    </body>
    
</html>