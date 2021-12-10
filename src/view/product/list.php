<?php foreach ($productList as $productInfo): ?>
    <div class="col">
        <div class="produit card" style="width: 30%;color:black;" >
        <img class="card-img-top" src="..." alt="Image du produit">
            <div class="card-body">
             
                <h5 class="card-title" ><?php echo $productInfo['nom']; ?></h5>
                <p class="card-text" style="margin:0px;"><?php echo $productInfo['prixActuel']; ?> €</p><p class="card-text" style="margin:0px;"><?php echo $productInfo['categorie']; ?></p>
                <p class="card-text" style="margin-top:0px;">En stock: <?php echo $productInfo['quantite']; ?></p>
                <a href="index.php?page=article&id=<?php echo $productInfo['idArticle']; ?>" class="btn btn-primary">Afficher</a>
            </div>
           
        </div>
    </div>
<?php endforeach; ?>

