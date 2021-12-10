<div class="Magasin p-3 pb-md-4 mx-auto text-center">
    <h1 style="color: white" class="display-4 fw-normal">Types d'articles</h1>
    <p class="fs-5 text-muted">Retrouvez ici tous les articles triés par catégories </p>
    <form method="post">
        <select name="filtre_qualite" style="display:inline-block; position: static; width: auto" id="filtre_type" class="form-select"
                aria-label="Default select example">
            <option selected>Choissisez le type d'article que vous voulez voir</option>
            <option value="1">régulier</option>
            <option value="2">rare</option>
            <option value="3">haut de gamme</option>
        </select>

        <select name="filtre_value" style="display: inline-block; margin-top: 3%;margin-left: 2%; position: static; width: auto;" id="filtre_prix"
                class="form-select"
                aria-label="Default select example">
            <option selected>Dans quel sens voulez vous voir</option>
            <option value="1">Prix croissant</option>
            <option value="2">Prix décroissant</option>
            <option value="3">Avec le plus de stock</option>
        </select>
        <input style="display: block; margin: 0 auto; margin-top: 3%;" class="btn btn-primary" type="submit" value="Rechercher">

    </form>
</div>

<?php

$filtre_value          = isset($_POST["filtre_value"])? $_POST["filtre_value"] :"";
$filtre_qualite        = isset($_POST["filtre_qualite"])? $_POST["filtre_qualite"] :"";

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

<div class="Presentation_site p-3 pb-md-4 mx-auto text-center">

    <?php include count($productList) ? PROJECT_ROOT_DIR . '/src/view/product/list.php' : PROJECT_ROOT_DIR . '/src/view/product/noProducts.php'; ?>

</div>