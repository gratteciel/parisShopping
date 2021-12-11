<div id="carouselExampleCaptions" style="margin: auto" class="carousel slide w-50" data-bs-ride="carousel">
    <div class="carousel-indicators">
        <?php foreach ($productList as $index => $productInfo): ?>
            <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="<?php echo $index; ?>"
                    <?php if (0 == $index): ?>class="active" aria-current="true"<?php endif; ?>
                    aria-label="<?php echo $productInfo['nom']; ?>"></button>

        <?php endforeach; ?>
    </div>
    <div class="carousel-inner">
        <?php foreach ($productList as $index => $productInfo): ?>
            <div class="carousel-item <?php if (0 == $index): ?>active<?php endif; ?>">
                <img style="height: 600px;" src="../<?php echo $productInfo['photoPrincipale']; ?>"
                     class="d-block w-100" alt="<?php echo $productInfo['nom']; ?>">
                <div class="carousel-caption d-none d-md-block">
                    <h5><?php echo $productInfo['nom']; ?></h5>
                    <a href="index.php?page=article&id=<?php echo $productInfo['idArticle']; ?>" class="bouton_Acheter">
                        <button type="button" class="w-100 btn btn-lg btn-outline-info">Afficher</button>
                    </a>
                    <p><?php echo $productInfo['prixActuel']; ?> €</>
                </div>
            </div>

        <?php endforeach; ?>
    </div>
    <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Previous</span>
    </button>
    <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Next</span>
    </button>
</div>