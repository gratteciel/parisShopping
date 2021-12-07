<?php foreach ($productList as $productInfo): ?>
    <div class="col">
        <div class="produit">
            <h4 class="Nom_du_produit"><?php echo $productInfo['nom']; ?></h4>
            <a href="product.php?id=<?php echo $productInfo['idArticle']; ?>" class="bouton_Acheter">
                <button type="button" class="w-100 btn btn-lg btn-outline-info">Acheter</button>
            </a>
            <div class="alert alert-warning" role="alert">
                <?php echo $productInfo['prixActuel']; ?> €
            </div>
        </div>
    </div>
<?php endforeach; ?>