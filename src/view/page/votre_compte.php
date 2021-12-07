<?php
    
     $logged=false;
     if(isset($_SESSION['LOGGED'])){
         if($_SESSION['LOGGED']){ //Si connecté
            //Connexion à la base de donnée
            include('bdd/connectBDD.php');
            $logged=true;

            //Chargement des adresses
            $adresses = requeteSqlArray("SELECT * from adresse where utilisateurId = '{$_SESSION['idUtilisateur']}'",$pdo);
            $nombreAdresses = 0;
            $nombreAdresses = sizeof($adresses);

            //Chargement des moyens de paiement
            $paiements = requeteSqlArray("SELECT * from paiement where utilisateurId = '{$_SESSION['idUtilisateur']}'",$pdo);
            $nombrePaiements = 0;
            $nombrePaiements = sizeof($paiements);
          
         }
             
     }

     function afficherValeurSession($stringValeur){
        if(isset($_SESSION[$stringValeur])){
            return $_SESSION[$stringValeur];
        }
        return "Erreur de chargement de ". $stringValeur;
     }
?>

<?php if($logged) : ?>
<div class="Presentation_site p-3 pb-md-4 mx-auto text-center">
    <h1 style="color: white" class="display-4 fw-normal">Votre compte</h1>
    
</div>
<p  class="text-light">Nom: <?php echo afficherValeurSession('nom'); ?></p>
<p  class="text-light">prenom: <?php echo afficherValeurSession('prenom'); ?></p>
<p  class="text-light">pseudo: <?php echo afficherValeurSession('pseudo');  ?></p>
<p  class="text-light">mail: <?php echo afficherValeurSession('mail'); ?></p>
<h2  class="text-light">Nombres d'adresses enregistrées : <?php echo $nombreAdresses ?></p>
<h2  class="text-light">Nombres de moyens de paiement enregistrés : <?php echo $nombrePaiements ?></p>

<?php else : ?>
    <div class="d-flex justify-content-center text-danger">Vous n'êtes pas connecté</div>
<?php endif; ?>