<?php

    $filtre_value        = isset($_REQUEST["filtre_value"])? $_REQUEST["filtre_value"] :"";
    $filtre_qualite        = isset($_REQUEST["filtre_qualite"])? $_REQUEST["filtre_qualite"] :"";

    switch ($filtre_qualite) {
        case 1:
            $filtre_qualite_valeur = "régulier";
            break;
        case 2:
            $filtre_qualite_valeur = "rare";
            break;
        case 3:
            $filtre_qualite_valeur = "haut de gamme";
            break;
        default:
            $filtre_qualite_valeur = "";
            break;
    }
    
    switch ($filtre_value) {
        case 1:
            $filtre_value_valeur = "ai.prixActuel ASC";
    
            break;
        case 2:
            $filtre_value_valeur = "ai.prixActuel DESC";
    
            break;
        case 3:
            $filtre_value_valeur = "a.quantite DESC";
    
            break;
        default:
            $filtre_value_valeur = "";
            break;
    }
    
   
    if ($filtre_qualite_valeur == "" && $filtre_value_valeur == "") {
        $productList = requeteSqlArray("SELECT * from article a, articleimmediat ai where a.idArticle = ai.idArticle", $pdo);
    } elseif ($filtre_qualite_valeur == "") {
        $productList = requeteSqlArray("SELECT * from article a, articleimmediat ai where a.idArticle = ai.idArticle ORDER BY {$filtre_value_valeur}", $pdo);

    } elseif ($filtre_value_valeur == "") {
        $productList = requeteSqlArray(
            "SELECT * from article a, articleimmediat ai where a.idArticle = ai.idArticle AND a.categorie = '{$filtre_qualite_valeur}'",
            $pdo
        );

    } else {
        $productList = requeteSqlArray(
            "SELECT * from article a, articleimmediat ai where a.idArticle = ai.idArticle AND a.categorie = '{$filtre_qualite_valeur}' ORDER BY {$filtre_value_valeur}",
            $pdo
        );
    }
?>



<div class="Magasin p-3 pb-md-4 mx-auto text-center">
    <h1 style="color: white" class="display-4 fw-normal">Types d'articles</h1>
    <p class="fs-5 text-muted">Retrouvez ici tous les articles triés par catégories </p>
    <form method="post" action="script_php/toutParcourir.php">
        <select name="filtre_qualite" style="display:inline-block; position: static; width: auto" id="filtre_type" class="form-select"
                aria-label="Default select example">
            <?php if($filtre_qualite=="") : ?>
                <option value="" selected>Catégorie</option>
            <?php else : ?>
                <option >Catégorie</option>
            <?php endif;  ?>
            <?php if($filtre_qualite=="1") : ?>
                <option value="1" selected>régulier</option>
            <?php else : ?>
                <option value="1">régulier</option>
            <?php endif; ?>
            <?php if($filtre_qualite=="2") : ?>
                <option value="2" selected>rare</option>
            <?php else : ?>
                <option value="2">rare</option>
            <?php endif; ?>
            <?php if($filtre_qualite=="3") : ?>
                <option value="3" selected>haut de gamme</option>
            <?php else : ?>
                <option value="3">haut de gamme</option>
            <?php endif; ?>

        </select>

        <select name="filtre_value" style="display: inline-block; margin-top: 3%;margin-left: 2%; position: static; width: auto;" id="filtre_prix"
                class="form-select"
                aria-label="Default select example">

            
            <?php if($filtre_value=="") : ?>
                <option value="" selected>Dans quel sens voulez vous voir</option>
            <?php else : ?>
                <option value="">Dans quel sens voulez vous voir</option>
            <?php endif; ?>

            <?php if($filtre_value=="1") : ?>
                <option value="1" selected>Prix croissant</option>
            <?php else : ?>
                <option value="1">Prix croissant</option>
            <?php endif; ?>
            
            <?php if($filtre_value=="2") : ?>
                <option value="2" selected>Prix décroissant</option>
            <?php else : ?>
                <option value="2">Prix décroissant</option>
            <?php endif; ?>
                
            <?php if($filtre_value=="3") : ?>
                <option value="3" selected>Avec le plus de stock</option>
            <?php else : ?>
                <option value="3">Avec le plus de stock</option>
            <?php endif; ?>
            
        </select>
        <input style="display: block; margin: 0 auto; margin-top:10px;" class="btn btn-secondary" type="submit" value="Rechercher">
            <h5 style="margin-top:10px;"><?php echo sizeof($productList)?> articles trouvés</h5>
    </form>
</div>



<div class="Presentation_site p-3 pb-md-4 mx-auto">

    <?php include count($productList) ? PROJECT_ROOT_DIR . '/src/view/product/list.php' : PROJECT_ROOT_DIR . '/src/view/product/noProducts.php'; ?>

</div>