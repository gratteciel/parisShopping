<div class="Presentation_site p-3 pb-md-4 mx-auto text-center">
    <h1 style="color: white" class="display-4 fw-normal">Paris Shopping</h1>
    </br>
    <p class="fs-5 text-muted"> Amateurs de composants PC et de périphériques, vous êtes au bon endroit. </br> Délaissez Amazon, EBAY ou LDLC, ici vous trouverez forcément votre bonheur. Nous vous garantissons les meillleurs prix, et vous proposons de trier les produits selon vos envies : par prix, stocks restants, rareté...    </p>
</div>

<?php
     $productList = requeteSqlArray("SELECT * from article a, articleimmediat ai where a.idArticle = ai.idArticle ORDER BY a.nombreVendu DESC  LIMIT 6",$pdo);
?>

<div class="Presentation_site p-3 pb-md-4 mx-auto text-center">

    <h5 id="ventesFlash">Ventes Flash</h5>


    <?php include count($productList) ?  PROJECT_ROOT_DIR. '/src/view/product/caroussel.php' : PROJECT_ROOT_DIR . '/src/view/product/noProducts.php'; ?>

</div>

<!-- Partie Google Map -->
<div id="map-container-google-1" class="z-depth-1-half map-container" >
<iframe id="map" style="border: 0;" src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d1312.6667734652472!2d2.2854332!3d48.8518497!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x47e6701b4f58251b%3A0x167f5a60fb94aa76!2sECE%20Paris%20Lyon!5e0!3m2!1sfr!2sfr!4v1638789588604!5m2!1sfr!2sfr" frameborder="0"></iframe>
</div>



