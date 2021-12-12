<?php foreach ($productList as $productInfo): ?>

    <?php 
         date_default_timezone_set('Europe/Paris');
         $date = date('Y-m-d H:i:s', time());
        $typeArticle="Achat immédiat";
        if($productInfo['idArticleImmediat']==null && $productInfo['idArticleNegociation']==null)
            $typeArticle="Achat par meilleure offre";
        else if($productInfo['idArticleImmediat']==null && $productInfo['idArticleEnchere']==null)
            $typeArticle="Achat par négociation";
        ?>

    <div class="col">
    <a href="index.php?page=article&id=<?php echo $productInfo['idArticle']; ?>" >
        <div class="produit card" style="width: 30%;color:black;" >

            <img style="height: 300px;" class="card-img-top" src="../<?php echo $productInfo['photoPrincipale']; ?>" alt="Image du produit">
            <div class="card-body">

                <h5 class="card-title" ><?php echo $productInfo['nom']; ?></h5>
                <p class="card-text" style="margin:0px;"><?php echo$typeArticle; ?></p>
                
                <p class="card-text" style="margin:0px;"><?php echo $productInfo['categorie']; ?></p>
                <?php if($typeArticle=="Achat immédiat"): ?>
                    <p class="card-text" style="margin:0px;"><?php echo $productImmSelonId[$productInfo['idArticle']]['prixActuel']; ?> €</p>
                    <p class="card-text" style="margin-top:0px;"> <?php echo $productImmSelonId[$productInfo['idArticle']]['quantite']; ?> en stock</p>
                <?php elseif($typeArticle=="Achat par meilleure offre"): ?>
                    <p class="card-text <?php if($productEnchereSelonId[$productInfo['idArticle']]['dateDebut']>$date) echo "text-danger"; ?>" style="margin:0px;">Date de début : <?php echo $productEnchereSelonId[$productInfo['idArticle']]['dateDebut']; ?></p>
                    <p class="card-text <?php if($productEnchereSelonId[$productInfo['idArticle']]['dateFin']<$date) echo "text-danger"; ?>" style="margin-top:0px;">Date de fin : <?php echo $productEnchereSelonId[$productInfo['idArticle']]['dateFin']; ?></p>
                <?php elseif($typeArticle=="Achat par négociation"): ?>
                    <p class="card-text" style="margin:0px;">Prix de base: <?php echo $productNegociationSelonId[$productInfo['idArticle']]['prixBase']; ?> €</p>
                <?php endif; ?>
          
            </div>

        </div>
        </a>
    </div>
<?php endforeach; ?>
