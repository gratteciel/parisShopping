<?php if(!LOGGED ) : ?>
    <div class="d-flex justify-content-center text-danger">Vous n'êtes pas connecté!</div>
    <?php elseif(!$_SESSION['estVendeur']) : ?>
    <div class="d-flex justify-content-center text-danger">Vous n'avez pas les droits!</div>

<?php else : ?>

    <?php endif; ?>