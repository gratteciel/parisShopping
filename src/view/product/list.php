<?php foreach ($productList as $productInfo): ?>
    <div class="col">
        <div class="produit" style="width: 30%;">

            <div class="card-body">
                <h4 class="Nom_du_produit"><?php echo $productInfo['nom']; ?></h4>
                <img class="card-img-top" src="..." alt="Card image cap">
                <a href="index.php?page=article&id=<?php echo $productInfo['idArticle']; ?>" class="bouton_Acheter">
                    <button type="button" class="w-100 btn btn-lg btn-outline-info">Afficher</button>
                </a>
            </div>
            <div class="alert alert-warning" role="alert">
                <?php echo $productInfo['prixActuel']; ?> €
            </div>
        </div>
    </div>
<?php endforeach; ?>

