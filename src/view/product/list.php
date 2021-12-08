<div class="col">
<?php foreach ($productList as $productInfo): ?>

        <div class="produit">
            <h4 class="Nom_du_produit"><?php echo $productInfo->name; ?></h4>
            <a href="product.php?id=<?php echo $productInfo->id; ?>" class="bouton_Acheter">
                <button type="button" class="w-100 btn btn-lg btn-outline-info">Acheter</button>
            </a>
            <div class="alert alert-warning" role="alert">
                <?php echo $productInfo->price; ?>EUR
            </div>
        </div>

<?php endforeach; ?>

</div>