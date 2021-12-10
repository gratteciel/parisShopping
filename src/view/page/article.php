<?php
    
    $article;

     if(isset($_GET['id'])){
      
        //Que avec article immediat
        $article = requeteSqlArray("SELECT * from article a, articleimmediat ai where a.idArticle = ai.idArticle and a.idArticle = '{$_GET['id']}'",$pdo);    
     }
     
    
     
?>

<?php if(!isset($_GET['id']) ||sizeof($article)==0 || sizeof($article)>1 ) : ?>
    <div class="d-flex justify-content-center text-danger">Aucun article trouvé</div>

<?php else : ?>
    <div class="article">
        <div>Nom : <?php echo $article[0]['nom'] ;?></div>
        <div>Prix actuel : <?php echo $article[0]['prixActuel'] ?> €</div>
        <div>Quantité : <?php echo $article[0]['quantite'] ?></div>
        <div>Catégorie : <?php echo $article[0]['categorie'] ?></div>
        <div>Description :
            <?php  if($article[0]['description']!=null) : ?>
                <?php echo $article[0]['description'] ?>
            <?php else : ?>
                Aucune description
            <?php endif; ?>
     </div>
    <?php if(LOGGED) : ?>
        <?php if($article[0]['quantite']<=0) : ?>
            <p style="color:red;margin-top:10px;margin-bottom:0px;">Plus en stock!</p>
        <?php else : ?>   
            <button onclick="location.href='script_php/panier/addArticle.php?idArticle=<?php echo $article[0]['idArticle'] ?>&idUtilisateur=<?php echo $_SESSION['idUtilisateur'] ?>&nom=<?php echo $article[0]['nom'] ?>'" type="button" class="btn btn-success">Ajouter au panier</button>
        <?php endif; ?>
    <?php else : ?>    
        <button onclick="location.href='Utilisateur/connexion.php'" type="button" class="btn btn-success">Connectez vous pour ajouter au panier</button>
    <?php endif; ?>
    </div>

<?php endif; ?>
