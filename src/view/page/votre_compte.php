<?php
include_once PROJECT_ROOT_DIR . '/src/include/loginStatus.php';
include_once PROJECT_ROOT_DIR . '/src/include/Utilisateur.php';

if (empty($idUtilisateur)) {
    // redirect to user login
    header('Location: Utilisateur/connexion.php');
    exit();
}

$addressList = Utilisateur::addressList($pdo, $idUtilisateur);
$cardList = Utilisateur::cardList($pdo, $idUtilisateur);
?>
<div class="Presentation_site p-3 pb-md-4 mx-auto text-center">
    <h1 style="color: white" class="display-4 fw-normal">Votre compte</h1>
    
</div>
<p  class="text-light">Nom: <?php echo Utilisateur::afficherValeurSession('nom'); ?></p>
<p  class="text-light">prenom: <?php echo Utilisateur::afficherValeurSession('prenom'); ?></p>
<p  class="text-light">pseudo: <?php echo Utilisateur::afficherValeurSession('pseudo');  ?></p>
<p  class="text-light">mail: <?php echo Utilisateur::afficherValeurSession('mail'); ?></p>
<h2  class="text-light">Nombres d'adresses enregistrées : <?php echo count($addressList); ?></h2>
<h2  class="text-light">Nombres de moyens de paiement enregistrés : <?php echo count($cardList); ?></h2>

<!--    <div class="d-flex justify-content-center text-danger">Vous n'êtes pas connecté</div>
-->