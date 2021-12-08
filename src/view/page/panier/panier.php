<?php
    
 
     if(LOGGED){
        //Si connecté
            //Connexion à la base de donnée
            //include('bdd/connectBDD.php');
            $logged=true;

            //Chargement des articles dans le panier
            $articleImmediat = requeteSqlArray("SELECT * from article a, articleimmediat ai, articleInPanier ap where a.idArticle = ai.idArticle and a.idArticle = ap.articleId and (ap.utilisateurId = '{$_SESSION['idUtilisateur']}')",$pdo);
            
            //Pour l'instant il n'y a que achat immédiat
            /*$articleEnchere= requeteSqlArray("SELECT * from article a, articleimmediat ai where a.idArticle = ai.idArticle and a.idArticle = (select articleId from articleInPanier where utilisateurId = '{$_SESSION['idUtilisateur']}')",$pdo);

            $articleNegociation = requeteSqlArray("SELECT * from article a, articleimmediat ai where a.idArticle = ai.idArticle and a.idArticle = (select articleId from articleInPanier where utilisateurId = '{$_SESSION['idUtilisateur']}')",$pdo);*/
          
            $nombreArticles = 0;
            $nombreArticles = sizeof($articleImmediat); //+  sizeof($articleEnchere) +  sizeof($articleNegociation);  
            
               
     }
?>

<?php if(LOGGED) : ?>
<div class="container px-4 py-5" id="panier">

    <!-- En tete du body */
    /* Logo Panier */
    -->
    <svg xmlns="http://www.w3.org/2000/svg"  style="float: left" width="50" height="50" fill="currentColor" class="bi bi-basket3" viewBox="0 0 20 20">
        <path d="M5.757 1.071a.5.5 0 0 1 .172.686L3.383 6h9.234L10.07 1.757a.5.5 0 1 1 .858-.514L13.783 6H15.5a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5H.5a.5.5 0 0 1-.5-.5v-1A.5.5 0 0 1 .5 6h1.717L5.07 1.243a.5.5 0 0 1 .686-.172zM3.394 15l-1.48-6h-.97l1.525 6.426a.75.75 0 0 0 .729.574h9.606a.75.75 0 0 0 .73-.574L15.056 9h-.972l-1.479 6h-9.21z"/>
    </svg>
    <h1 class="pb-2 border-bottom"><?php echo $nombreArticles?> <?php  ($nombreArticles <2) ? print("Article") : print("Articles");?> dans Mon panier</h1>

   

     
        <?php $productList =$articleImmediat; include('view/page/panier/produitsPanier.php'); ?>

    

</div>
<?php else : ?>
    <div class="d-flex justify-content-center text-danger">Vous n'êtes pas connecté</div>
<?php endif; ?>