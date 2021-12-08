<?php
include_once PROJECT_ROOT_DIR . '/src/include/loginStatus.php';
include_once PROJECT_ROOT_DIR . '/src/include/Utilisateur.php';

if (empty($idUtilisateur)) {
    // redirect to user login
    header('Location: Utilisateur/connexion.php');
    exit();
}

$addressList = Utilisateur::addressList($pdo, $idUtilisateur);
$cardList    = Utilisateur::cardList($pdo, $idUtilisateur);
?>
<div class="Presentation_site p-3 pb-md-4 mx-auto text-center">
    <h1 style="color: white" class="display-4 fw-normal">Votre compte</h1>

</div>
<p class="text-light">Nom: <?php echo Utilisateur::afficherValeurSession('nom'); ?></p>
<p class="text-light">prenom: <?php echo Utilisateur::afficherValeurSession('prenom'); ?></p>
<p class="text-light">pseudo: <?php echo Utilisateur::afficherValeurSession('pseudo'); ?></p>
<p class="text-light">mail: <?php echo Utilisateur::afficherValeurSession('mail'); ?></p>
<h2 class="text-light">Nombres d'adresses enregistrées : <?php echo count($addressList); ?></h2>

<?php foreach ($addressList as $adress): ?>
    <ul class="ul_presentation_site"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-house" viewBox="0 0 16 16">
            <path fill-rule="evenodd"
                  d="M2 13.5V7h1v6.5a.5.5 0 0 0 .5.5h9a.5.5 0 0 0 .5-.5V7h1v6.5a1.5 1.5 0 0 1-1.5 1.5h-9A1.5 1.5 0 0 1 2 13.5zm11-11V6l-2-2V2.5a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5z"/>
            <path fill-rule="evenodd" d="M7.293 1.5a1 1 0 0 1 1.414 0l6.647 6.646a.5.5 0 0 1-.708.708L8 2.207 1.354 8.854a.5.5 0 1 1-.708-.708L7.293 1.5z"/>
        </svg><?php
        echo "  ". $adress['numeroVoie'];
        echo  "  " . $adress['rue'];
        echo "  ". $adress['ville'];
        echo "  ". $adress['codePostal'];
        echo "  ".  $adress['nom'];
        echo "  ".  $adress['prenom'];
        ?>
    </ul>
<?php endforeach; ?>




<h2 class="text-light">Nombres de moyens de paiement enregistrés : <?php echo count($cardList); ?></h2>
        <?php foreach ($cardList as $card): ?>
        <ul class="ul_presentation_site"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-credit-card" viewBox="0 0 16 16">
                <path d="M0 4a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v8a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V4zm2-1a1 1 0 0 0-1 1v1h14V4a1 1 0 0 0-1-1H2zm13 4H1v5a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1V7z"/>
                <path d="M2 10a1 1 0 0 1 1-1h1a1 1 0 0 1 1 1v1a1 1 0 0 1-1 1H3a1 1 0 0 1-1-1v-1z"/>
            </svg><?php
            echo "  ". $card['typeCarte'];
            echo  "  " . $card['numeroCarte'];
            echo "  ". $card['nomCarte'];
            echo "  ". $card['dateExpiration'];
            echo "  ".  $card['codeSecurite'];
            ?>
            <?php endforeach; ?>

