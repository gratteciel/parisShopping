<?php
       include_once PROJECT_ROOT_DIR . '/src/include/loginStatus.php';
       include_once PROJECT_ROOT_DIR . '/src/include/Utilisateur.php';
  
     if(LOGGED){    //Si connecté
        $msgErreur="";
        
        if(isset($_REQUEST['err']) && isset($_REQUEST['val'])){
            if($_REQUEST['err']=='codeSecuPasBon')
                $msgErreur="Le code de sécurité de la carte finissant par *-" . $_REQUEST['val'] ." n'est pas bon!";
        }
        
        $total=0;
        
        $addressList = Utilisateur::addressList($pdo, $idUtilisateur);
        $cardList    = Utilisateur::cardList($pdo, $idUtilisateur);
        
        //Chargement des articles dans le panier
        $articleImmediat = requeteSqlArray("SELECT * from article a, articleimmediat ai, articleInPanier ap where a.idArticle = ai.idArticle and a.idArticle = ap.articleId and (ap.utilisateurId = '{$_SESSION['idUtilisateur']}')",$pdo);
        


        //Pour l'instant il n'y a que achat immédiat
        /*$articleEnchere= requeteSqlArray("SELECT * from article a, articleimmediat ai where a.idArticle = ai.idArticle and a.idArticle = (select articleId from articleInPanier where utilisateurId = '{$_SESSION['idUtilisateur']}')",$pdo);

        $articleNegociation = requeteSqlArray("SELECT * from article a, articleimmediat ai where a.idArticle = ai.idArticle and a.idArticle = (select articleId from articleInPanier where utilisateurId = '{$_SESSION['idUtilisateur']}')",$pdo);*/
        
        $nombreArticles = 0;
        $nombreArticles = sizeof($articleImmediat); //+  sizeof($articleEnchere) +  sizeof($articleNegociation);  
            
        foreach ($articleImmediat as $a){
            $total += $a['prixActuel'];
        }
               
     }
?>

<?php if(LOGGED) : ?>
<div class="container px-4 py-5" id="panier">
    <?php $page='panier/panier'; include('view/page/html/ajouterAdresse.php');?>
    <?php include('view/page/html/ajouterPaiement.php');?>
    <!-- En tete du body */
    /* Logo Panier */
    -->
    <svg xmlns="http://www.w3.org/2000/svg"  style="float: left" width="50" height="50" fill="currentColor" class="bi bi-basket3" viewBox="0 0 20 20">
        <path d="M5.757 1.071a.5.5 0 0 1 .172.686L3.383 6h9.234L10.07 1.757a.5.5 0 1 1 .858-.514L13.783 6H15.5a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5H.5a.5.5 0 0 1-.5-.5v-1A.5.5 0 0 1 .5 6h1.717L5.07 1.243a.5.5 0 0 1 .686-.172zM3.394 15l-1.48-6h-.97l1.525 6.426a.75.75 0 0 0 .729.574h9.606a.75.75 0 0 0 .73-.574L15.056 9h-.972l-1.479 6h-9.21z"/>
    </svg>
    
  
        <h1 class="pb-2 border-bottom flexEspaceEntre"><?php echo $nombreArticles?> <?php  ($nombreArticles <2) ? print("Article") : print("Articles");?> dans Mon panier (<?php echo $total?>€)

        <button id="afficher" type="button" style="color:white;padding-top:0;padding-bottom:0;" class="btn btn-outline-secondary " onclick="afficherOuPas('produits')">Afficher le détail</button></h1>

        <div id="produits" style="display:block;margin-top:30px;">
            <?php $productList =$articleImmediat; include('view/page/panier/produitsPanier.php'); ?>
        </div>

    <div id="payer" class="border" style="width:100%;padding:10px;margin-top:50px;">
        <h3>Veuillez renseigner vos informations avant de passer au paiement</h3>
        

        <form action="script_php/payer.php" method="post" onsubmit = "return validateForm('payer',['adressePayer','paiementPayer','codeSecuPayer'],'errordiv3')">
        <div id="errordiv3" style="color:red;margin-left: 6px;"><?php echo $msgErreur?></div>
            <div style="display:flex;flex-direction:row;justify-content:space-around;margin-top:20px;">
                <div>
                    <label style="margin-bottom: 5px;" for="adressePayer">Adresse de facturation</label>
                    <a href="" data-bs-toggle="modal" data-bs-target="#exampleModal" class='aAjouter'>
                    (Ajouter)
                    </a>
                    
                    <select name="adressePayer" id="adressePayer" class="form-select col" style="width:250px" >
                    <?php if(sizeof($addressList)!=0) : ?>
                        <?php foreach ($addressList as $adress): ?>
                            <option value="<?php echo $adress['idAdresse']?>"><?php echo $adress['numeroVoie'] ." ". $adress['rue'] . ", " .$adress['ville']?></option>
                        <?php endforeach; ?>
                    <?php else : ?>
                        <option value="">Aucune adresse</option>
                        <?php endif; ?>
                    </select>
                    
                 
                    
                </div>
                <div>
                    <label style="margin-bottom: 5px;" for="paiementPayer">Moyen de paiement</label>
                    <a href="" data-bs-toggle="modal" data-bs-target="#exampleModal2" class='aAjouter'>
                    (Ajouter)
                    </a>
                    <select name="paiementPayer" id="paiementPayer" class="form-select col" style="width:250px">
                    

                    <?php if(sizeof($cardList)!=0) : ?>
                    <?php foreach ($cardList as $card): ?>
                        <option value="<?php echo $card['idPaiement']?>"><?php echo $card['typeCarte'] ." - ". "****-****-****-" . substr($card['numeroCarte'], -4)?></option>
                    <?php endforeach; ?>
                    <?php else : ?>
                        <option value="">Aucune carte</option>
                    <?php endif; ?>
                    </select>
                </div>

                <div>
                    <label style="margin-bottom: 5px;" for="codeSecuPayer">Code de sécurité de la carte</label>
                    <input type="text" 
                            class="form-control" 
                            style="width:46%"
                            name="codeSecuPayer"
                            id="codeSecuPayer"
                            >
                </div>
                <div>
                    <button style="margin-top: 40%;" type="submit" name="submit" class="btn btn-primary">Payer</button>
                </div>
                
            </div>
            
        </form>
   
    </div>
    

</div>
<?php else : ?>
    <div class="d-flex justify-content-center text-danger">Vous n'êtes pas connecté</div>
<?php endif; ?>

<script src="script_js/validationForm.js"></script>