<?php
include_once __DIR__ . '/../../bdd/donneeSession.php';
include_once __DIR__ . '/../../../config/config.php';
include_once __DIR__ . '/../../bdd/connectBDD.php';
include_once __DIR__ . '/../../include/Admin.php';
?>

<!-- Protect administrateur pages -->
<?php if (empty($_SESSION['estAdmin'])): ?>
    <h1>You are not allowed to access this page! Please login as Administrateur!</h1>
    <?php exit(); ?>
<?php endif; ?>


<div class="container px-4 py-5" id="featured-3">
    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#ajouterVendeurModal">
        Ajouter un vendeur
    </button>
    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#rechercherVendeur">
        Rechercher un vendeur
    </button>
    <?php $page='administrateur'; include('html/ajouterVendeur.php');?>
    <?php $page='administrateur'; include('html/rechercherVendeur.php');?>

    <?php
        if (!empty($_SESSION['rechercherVendeurResults']) && !empty($_GET['tA']) && $_GET['tA'] === 'rechercheVendeurSuccess') {
            include 'html/rechercherVendeurResults.php';
            // uncomment next line if you want to not show the results if you refresh the page
            // unset($_SESSION['rechercherVendeurResults']);
        }
    ?>

</div>


<script src="script_js/validationForm.js?<?php echo time();?>"></script>
