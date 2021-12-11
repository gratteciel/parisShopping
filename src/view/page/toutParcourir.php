<?php

    function renvoieKeyId($productSql){
        $productSelonId;
        foreach($productSql as $p){
            $productSelonId[$p['idArticle']] = $p;
        }
        return $productSelonId;
    }

    $filtre_value        = isset($_REQUEST["filtre_value"])? $_REQUEST["filtre_value"] :"";
    $filtre_qualite        = isset($_REQUEST["filtre_qualite"])? $_REQUEST["filtre_qualite"] :"";
    $fType        = isset($_REQUEST["fType"])? $_REQUEST["fType"] :"";

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
            $filtre_value_valeur = "ai.quantite DESC";
    
            break;
        default:
            $filtre_value_valeur = "";
            break;
    }

    if($fType!=1 && $fType!=2 && $fType!=3){
        $fType="";
    }


    
   
    if ($filtre_qualite_valeur == ""  && $fType == "") { //Si selon rien
     
        $productList=requeteSqlArray("SELECT * from article", $pdo);
        
        $productImmediat=requeteSqlArray("SELECT * from article a, articleimmediat ai where a.idArticleImmediat = ai.idArticleImmediat", $pdo);
        $productEnchere=requeteSqlArray("SELECT * from article a,  articleenchere ae where a.idArticleEnchere = ae.idArticleEnchere", $pdo);
     
        if(sizeof($productEnchere)>0)
            $productEnchereSelonId= renvoieKeyId($productEnchere);
        if(sizeof($productImmediat)>0)
            $productImmSelonId= renvoieKeyId($productImmediat);
       
        
    
        
    }elseif($filtre_qualite_valeur == ""){ //Si selon type achat
        if($fType==1){ //Si achat immédiat
            $productList=requeteSqlArray("SELECT * from article a, articleimmediat ai where a.idArticleImmediat = ai.idArticleImmediat", $pdo);
            $productImmediat=requeteSqlArray("SELECT * from article a, articleimmediat ai where a.idArticleImmediat = ai.idArticleImmediat", $pdo);
            if(sizeof($productImmediat)>0)
                $productImmSelonId= renvoieKeyId($productImmediat);
        }
        else if($fType==2){//Si achat par meilleure offre
            $productList=requeteSqlArray("SELECT * from article a,  articleenchere ae where a.idArticleEnchere = ae.idArticleEnchere", $pdo);
            $productEnchere=requeteSqlArray("SELECT * from article a,  articleenchere ae where a.idArticleEnchere = ae.idArticleEnchere", $pdo);
     
            if(sizeof($productEnchere)>0)
            $productEnchereSelonId= renvoieKeyId($productEnchere);
        }
    } 
    
    
    /*elseif ($filtre_qualite_valeur == "" && $filtre_value_valeur != "" && $fType == "") {
        $productList = requeteSqlArray("SELECT * from article a, articleimmediat ai where a.idArticle = ai.idArticle ORDER BY {$filtre_value_valeur}", $pdo);
        $productImmediat=requeteSqlArray("SELECT * from article a, articleimmediat ai where a.idArticleImmediat = ai.idArticleImmediat", $pdo);
 
        $productImmSelonId= renvoieKeyId($productImmediat);

    }*/ elseif ($fType == "") {
        $productList = requeteSqlArray(
            "SELECT * from article a where a.categorie = '{$filtre_qualite_valeur}'",
            $pdo
        );
       
        
        $productImmediat=requeteSqlArray("SELECT * from article a, articleimmediat ai where a.idArticleImmediat = ai.idArticleImmediat", $pdo);
        $productEnchere=requeteSqlArray("SELECT * from article a,  articleenchere ae where a.idArticleEnchere = ae.idArticleEnchere", $pdo);

        if(sizeof($productEnchere)>0)
            $productEnchereSelonId= renvoieKeyId($productEnchere);
        if(sizeof($productImmediat)>0)
            $productImmSelonId= renvoieKeyId($productImmediat);
       

    } /*else {
        $productList = requeteSqlArray(
            "SELECT * from article a, articleimmediat ai where a.idArticle = ai.idArticle AND a.categorie = '{$filtre_qualite_valeur}' ORDER BY {$filtre_value_valeur}",
            $pdo
        );
    }*/
    else{ //Si catégorie + type d'achat
        if($fType==1){ //Si achat immédiat
            $productList=requeteSqlArray("SELECT * from article a, articleimmediat ai where a.idArticleImmediat = ai.idArticleImmediat and a.categorie = '{$filtre_qualite_valeur}'", $pdo);
            $productImmediat=requeteSqlArray("SELECT * from article a, articleimmediat ai where a.idArticleImmediat = ai.idArticleImmediat", $pdo);
            if(sizeof($productImmediat)>0)
                $productImmSelonId= renvoieKeyId($productImmediat);
        }
        else if($fType==2){//Si achat par meilleure offre
            $productList=requeteSqlArray("SELECT * from article a,  articleenchere ae where a.idArticleEnchere = ae.idArticleEnchere and a.categorie = '{$filtre_qualite_valeur}'", $pdo);
            $productEnchere=requeteSqlArray("SELECT * from article a,  articleenchere ae where a.idArticleEnchere = ae.idArticleEnchere", $pdo);
     
            if(sizeof($productEnchere)>0)
            $productEnchereSelonId= renvoieKeyId($productEnchere);
        }
    }
?>



<div class="Magasin p-3 pb-md-4 mx-auto text-center">
    <h1 style="color: white" class="display-4 fw-normal">Types d'articles</h1>
    <p class="fs-5 text-muted">Retrouvez ici tous les articles triés par catégories </p>
    <form method="post" action="script_php/toutParcourir.php">
        <select name="filtre_qualite" style="display:inline-block; position: static; width: 13%" id="filtre_qualite" class="form-select"
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
        
        <select name="filtre_type" style="display:inline-block; position: static; width: 13%;margin-left: 2%;" id="filtre_type" class="form-select"
                aria-label="Default select example">
            <?php if($fType=="") : ?>
                <option value="" selected>Type d'achat</option>
            <?php else : ?>
                <option >Type d'achat</option>
            <?php endif;  ?>
            <?php if($fType=="1") : ?>
                <option value="1" selected>Immédiat</option>
            <?php else : ?>
                <option value="1">Immédiat</option>
            <?php endif; ?>
            <?php if($fType=="2") : ?>
                <option value="2" selected>Enchere</option>
            <?php else : ?>
                <option value="2">Enchere</option>
            <?php endif; ?>
            <?php if($fType=="3") : ?>
                <option value="3" selected>Négociation</option>
            <?php else : ?>
                <option value="3">Négociation</option>
            <?php endif; ?>

        </select>
<?php if(1==0) :?>
        <select name="filtre_value" style="display: inline-block; margin-top: 3%;margin-left: 2%; position: static; width: auto;" id="filtre_prix"
                class="form-select"
                aria-label="Default select example"
                tabindex="1" data-bs-toggle="popover" data-bs-trigger="hover focus"  data-bs-content="Que pour les articles immédiats" data-html="true">

            
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
<?php endif; ?>
        <input style="display: block; margin: 0 auto; margin-top:10px;" class="btn btn-secondary" type="submit" value="Rechercher">
            <h5 style="margin-top:10px;"><?php echo sizeof($productList)?> articles trouvés</h5>
    </form>
</div>



<div class="Presentation_site p-3 pb-md-4 mx-auto">

    <?php include count($productList) ? PROJECT_ROOT_DIR . '/src/view/product/list.php' : PROJECT_ROOT_DIR . '/src/view/product/noProducts.php'; ?>

</div>