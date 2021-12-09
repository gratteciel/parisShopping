<?php

    //Tous les articles en achat immédiat
    $productList = requeteSqlArray("SELECT * from article a, articleimmediat ai where a.idArticle = ai.idArticle",$pdo);
?>

<div class="Magasin p-3 pb-md-4 mx-auto text-center">
    <h1 style="color: white" class="display-4 fw-normal">Types d'articles</h1>
    <p class="fs-5 text-muted">Retrouvez ici tous les articles triés par catégories </p>
    <ul>
    </ul>
</div>


    <div class="Presentation_site p-3 pb-md-4 mx-auto text-center">

        <?php include count($productList) ? 'view/product/list.php' : '../product/noProducts.php'; ?>

    </div>