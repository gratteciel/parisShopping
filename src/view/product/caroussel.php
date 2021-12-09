<div id="carouselExampleCaptions" style="margin: auto" class="carousel slide w-50" data-bs-ride="carousel">
    <div class="carousel-indicators">
        <?php foreach ($productList as $index => $productInfo): ?>
            <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="<?php echo $index; ?>"
                    <?php if (0 == $index): ?>class="active" aria-current="true"<?php endif; ?>
                    aria-label="<?php echo $productInfo['nom']; ?>"></button>
            <?php
              // remove this after you set image in database
            $randomImg = [
                    'https://img-19.ccm2.net/WNCe54PoGxObY8PCXUxMGQ0Gwss=/480x270/smart/d8c10e7fd21a485c909a5b4c5d99e611/ccmcms-commentcamarche/20456790.jpg',
                    'https://lh3.googleusercontent.com/proxy/20Vz2aauS3uQBIRCP_7AnvK_GbrGC6Bit5hPUtLK4ewZL8wuR_jT4ffdqzuxVamHrrfat9FyuvpBH9F9MwuQeUmv7bbYsM-ju0VJ83dHFvk5q7p7jw',
                    'https://ak.picdn.net/shutterstock/videos/1007711989/thumb/11.jpg?ip=x480',
                ];
        $productList[$index]['img_src'] = $randomImg[$index%3];
            ;
            ?>
        <?php endforeach; ?>
    </div>
    <div class="carousel-inner">
        <?php foreach ($productList as $index => $productInfo): ?>
            <div class="carousel-item <?php if (0 == $index): ?>active<?php endif; ?>">
                <img src="<?php echo $productInfo['img_src']; ?>"
                     class="d-block w-100" alt="<?php echo $productInfo['nom']; ?>">
                <div class="carousel-caption d-none d-md-block">
                    <h5><?php echo $productInfo['nom']; ?></h5>
                    <a href="index.php?page=article&id=<?php echo $productInfo['idArticle']; ?>" class="bouton_Acheter">
                        <button type="button" class="w-100 btn btn-lg btn-outline-info">Afficher</button>
                    </a>
                    <p><?php echo $productInfo['prixActuel']; ?> €</p>
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