<div class="container px-4 py-5" id="featured-3">
    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#ajouterVendeurModal">
        Ajouter un vendeur
    </button>
    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#rechercherVendeur">
        Rechercher un vendeur
    </button>
    <?php $page='administrateur'; include('html/ajouterVendeur.php');?>
    <?php $page='administrateur'; include('html/rechercherVendeur.php');?>


</div>

<script src="script_js/validationForm.js?<?php echo time();?>"></script>
