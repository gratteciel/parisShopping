<?php
    


     if(isset($_GET['id'])){
      
        //Que avec article immediat
        $article = requeteSqlArray("SELECT * from article a, articleimmediat ai where a.idArticle = ai.idArticle and a.idArticle = '{$_GET['id']}'",$pdo);
        $alerte = requeteSqlArray("SELECT * from alerteStock where idArticle = '{$_GET['id']}' and idUtilisateur = '{$_SESSION['idUtilisateur']}' ",$pdo);
     }

?>

<?php if(sizeof($article)==0 || sizeof($article)>1) : ?>
    <div class="d-flex justify-content-center text-danger">Aucun article trouvé</div>

<?php else : ?>
    <div class="article">
        <div>Nom : <?php echo $article[0]['nom'] ;?></div>
        <div class="Notif_Bouton">
            <?php if(sizeof($alerte)==0) : ?>
                    <button onclick="location.href='script_php/Alerte/addAlerte.php?idArticle=<?php echo $article[0]['idArticle'] ?>&nom=<?php echo $article[0]['nom'] ?>'" class="buttonNoti" type="button">
                    <span class="icon">
                        <img src="../images/alarm.png" style="width:21px;" alt="">
                    </span>
                    </button>
            <?php else : ?>
                    <button onclick="location.href='script_php/Alerte/suppAlerte.php?idArticle=<?php echo $article[0]['idArticle'] ?>&nom=<?php echo $article[0]['nom'] ?>'" class="buttonNoti" type="button">
                        <img class="logoOn" src="../images/alarmOn.png" style="width:21px;" alt="">
                    </button>
            <?php endif; ?>
        </div>
        <div>Prix actuel : <?php echo $article[0]['prixActuel'] ?> €</div>
        <div>Quantité : <?php echo $article[0]['quantite'] ?></div>

        <div>Description :
            <?php  if($article[0]['description']!=null) : ?>
                <?php echo $article[0]['description'] ?>
            <?php else : ?>
                Aucune description
            <?php endif; ?>
     </div>
    <?php if(LOGGED) : ?>
        <button onclick="location.href='script_php/panier/addArticle.php?idArticle=<?php echo $article[0]['idArticle'] ?>&idUtilisateur=<?php echo $_SESSION['idUtilisateur'] ?>&nom=<?php echo $article[0]['nom'] ?>'" type="button" class="btn btn-success">Ajouter au panier</button>
    <?php else : ?>    
        <button onclick="location.href='Utilisateur/connexion.php'" type="button" class="btn btn-success">Connectez vous pour ajouter au panier</button>
    <?php endif; ?>
        <button onclick="location.href='script_php/Quantite/addQuantity.php?idArticle=<?php echo $article[0]['idArticle'] ?>&nom=<?php echo $article[0]['nom'] ?>'" type="button" class="btn btn-success">Ajouter article</button>
        <button onclick="location.href='script_php/Quantite/suppQuantity.php?idArticle=<?php echo $article[0]['idArticle'] ?>&nom=<?php echo $article[0]['nom'] ?>'" type="button" class="btn btn-success">Supprimer article</button>

    </div>

<?php endif; ?>
