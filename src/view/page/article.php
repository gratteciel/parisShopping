<?php
include_once PROJECT_ROOT_DIR . '/src/include/loginStatus.php';
include_once PROJECT_ROOT_DIR . '/src/include/Utilisateur.php';
    date_default_timezone_set('Europe/Paris');
    $date = date('Y-m-d H:i:s', time());
    $msgErreur="";
    $article;

     if(isset($_GET['id'])){
        
        if(isset($_REQUEST['err']) && isset($_REQUEST['val'])){
            if($_REQUEST['err']=='1')
                $msgErreur=$_REQUEST['val']; 
            else if($_REQUEST['err']=='codeSecuPasBon')
                $msgErreur="Le code de sécurité de la carte finissant par *-" . $_REQUEST['val'] ." n'est pas bon!";
            else if($_REQUEST['err']=='dateExpiration'){
                $msgErreur="Votre carte est expirée! (". $_REQUEST['val'] .")";
            }
           
        }
        
        $article = requeteSqlArray("SELECT * from article where idArticle = '{$_GET['id']}'",$pdo);
        if(sizeof($article)==1){
            $typeArticle=0;
            if($article[0]['idArticleImmediat']!=null){//articles immédiat
                $article = requeteSqlArray("SELECT * from article a, articleimmediat ai where a.idArticle = ai.idArticle and a.idArticle = '{$_GET['id']}'",$pdo);
            }
            else if($article[0]['idArticleEnchere']!=null){//article enchere
                $article = requeteSqlArray("SELECT * from article a, articleenchere ae where a.idArticle = ae.idArticle and a.idArticle = '{$_GET['id']}'",$pdo);
                $encherePrixMax = requeteSqlArray("SELECT MAX(prixMax) from enchere where idArticleEnchere = '{$article[0]['idArticleEnchere']}'",$pdo);
            
                if($encherePrixMax[0]['MAX(prixMax)']!=null)
                    $encherePrixMaxIdUtilisateur = requeteSqlArray("SELECT idUtilisateur from enchere where idArticleEnchere = '{$article[0]['idArticleEnchere']}' and prixMax = {$encherePrixMax[0]['MAX(prixMax)']}",$pdo);
                
                $typeArticle=1;
            }
            else if($article[0]['idArticleNegociation']!=null){//article enchere
                $article = requeteSqlArray("SELECT * from article a, articlenegociation an where a.idArticle = an.idArticle and a.idArticle = '{$_GET['id']}'",$pdo);

                $negociation = requeteSqlArray("SELECT * from negociation where idArticleNegociation='{$article[0]['idArticleNegociation']}'",$pdo);

                $negociationWithUser =requeteSqlArray("SELECT * from negociation where idArticleNegociation='{$article[0]['idArticleNegociation']}' and idUtilisateur = {$_SESSION['idUtilisateur']}",$pdo);

                
                $typeArticle=2;
            }
            
            if(LOGGED){
                $alerte = requeteSqlArray("SELECT * from alerteStock where idArticle = '{$_GET['id']}' and idUtilisateur = '{$_SESSION['idUtilisateur']}' ",$pdo);
                $addressList = Utilisateur::addressList($pdo, $idUtilisateur);
            $cardList    = Utilisateur::cardList($pdo, $idUtilisateur);
            }
            

            $checkIfVendeurTjrsLa =requeteSqlArray("SELECT u.estVendeur from utilisateur u, article a, vendeur v where a.idArticle = '{$_GET['id']}' and a.vendeurId = v.idVendeur and v.utilisateurId = u.idUtilisateur",$pdo);
            
            $venduParVendeur=false;
            if( sizeof($checkIfVendeurTjrsLa)>0){
                if( $checkIfVendeurTjrsLa[0]['estVendeur']==1)
                    $venduParVendeur = true;
            }
        }
        
        
    
     }
?>

<?php if(!isset($_GET['id']) ||sizeof($article)==0 || sizeof($article)>1 ) : ?>
    <div class="d-flex justify-content-center text-danger">Aucun article trouvé</div>

<?php else : ?>
    <div class="article">
        <div>Nom : <?php echo $article[0]['nom'] ;?></div>
        
    <?php if(LOGGED&& $typeArticle==0) : ?>
        <div class="Notif_Bouton" tabindex="0" data-bs-toggle="popover" data-bs-placement="bottom" data-bs-trigger="hover focus" data-bs-content="Permet de vous alerter en cas de rupture de stock ou quand l'article devient disponible à la vente">
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

        <?php endif; ?>
        <div>Catégorie : <?php echo $article[0]['categorie'] ?></div>
        
            <div>Description :
                <?php  if($article[0]['description']!=null) : ?>
                    <?php echo $article[0]['description'] ?>
                <?php else : ?>
                    Aucune description
                <?php endif; ?>
            </div>
     


        

        <?php if($typeArticle==0) : ?>
            <div>Prix actuel : <?php echo $article[0]['prixActuel'] ?> €</div>
            <div>En stock : <?php echo $article[0]['quantite'] ?></div>
            <div style="margin-top:10px;margin-bottom:3px;">Article en achat immédiat</div>
            <?php if(LOGGED) : ?>
                <?php if($article[0]['quantite']<=0) : ?>
                    <p style="color:red;margin-top:10px;margin-bottom:0px;">Plus en stock!</p>
                <?php elseif($venduParVendeur) : ?>   
                    <button onclick="location.href='script_php/panier/addArticle.php?idArticle=<?php echo $article[0]['idArticle'] ?>&idUtilisateur=<?php echo $_SESSION['idUtilisateur'] ?>&nom=<?php echo $article[0]['nom'] ?>'" type="button" class="btn btn-success">Ajouter au panier</button>
                <?php else : ?>  
                    <p style="color:red;margin-top:10px;margin-bottom:0px;">Cet article n'est plus vendu (aucun vendeur ne le vend)</p>
                <?php endif; ?>
            <?php else : ?>    
                <button onclick="location.href='Utilisateur/connexion.php'" type="button" class="btn btn-success">Connectez vous pour ajouter au panier</button>
            <?php endif; ?>

        <?php elseif($typeArticle==1) : ?>
            <div style="margin-top:10px;margin-bottom:3px;">Article en enchere (par meilleure offre)</div>
            <div>Date de début : <?php echo $article[0]['dateDebut'] ?></div>
            <div>Date de fin : <?php echo $article[0]['dateFin'] ?></div>

            <?php if($encherePrixMax[0]['MAX(prixMax)']!=null) : ?>
                <div style="margin-top:10px;margin-bottom:5px">Meilleure offre pour l'instant: <?php echo $encherePrixMax[0]['MAX(prixMax)'] ?>€
                <?php if(LOGGED) : ?>
                    <?php if($encherePrixMaxIdUtilisateur[0]['idUtilisateur'] ==$_SESSION['idUtilisateur'])
                        echo " (par vous)";
                        else
                            echo " (pas par vous)";
                        ?>
                <?php endif; ?>
            
            
            </div>
                
            <?php else : ?>
                <div style="margin-top:10px;margin-bottom:5px">Aucune offre pour l'instant</div> 
                <div style="margin-top:10px;margin-bottom:5px">Prix de départ de l'enchère: <?php echo $article[0]['prixDepart']?>€ </div> 
            <?php endif; ?>
            <?php if($date < $article[0]['dateDebut']) : ?>
                <p style="color:red;margin-top:10px;margin-bottom:0px;">L'enchère n'a pas commencé!</p>
            
            <?php elseif($article[0]['dateFin']> $date) : ?>
                <?php if(LOGGED) : ?>
                    <?php $page='article&id='.$article[0]['idArticle']; include('view/page/html/ajouterAdresse.php');?>
                    <?php include('view/page/html/ajouterPaiement.php');?>
                    <form action="script_php/enchere/encherir.php?idArtEnchere=<?php echo $article[0]['idArticleEnchere']?>&idArticle=<?php echo $article[0]['idArticle']?>" method="post" style="margin-top:10px;margin-bottom:5px" onsubmit = "return validateForm('encherir',['prix'],'errordiv')">
                   
                 
                            
                    <div style="display:flex;flex-direction:row;justify-content:space-around;margin-top:20px;">
                        <div style="width:10%;height:100%;margin-right:10px;">
                        <label for="prix">Votre prix</label>
                                    <input  class="form-control" type="number" name="prix" id="prix">
                                </div>    
                        <div>
                            <label style="margin-bottom: 5px;" for="adressePayer">Adresse de livraison</label>
                            <a href="" data-bs-toggle="modal" data-bs-target="#exampleModal" class='aAjouter'>
                            (Ajouter)
                            </a>
                            
                            <select name="adressePayer" id="adressePayer" class="form-select col" style="width:250px" tabindex="0" data-bs-toggle="popover" data-bs-trigger="hover focus"  data-bs-content="Si vous remportez l'enchère, l'article sera livré à cet adresse" data-html="true"  data-bs-placement="bottom">
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
                            <select name="paiementPayer" id="paiementPayer" class="form-select col" style="width:250px" tabindex="1" data-bs-toggle="popover" data-bs-trigger="hover focus"  data-bs-content="Si vous remportez l'enchère, l'article sera payé avec les informations de cette carte" data-html="true"  data-bs-placement="bottom">
                            

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
                            <button  style="margin-top:35%" type="submit" name="submit" class="btn btn-primary mb-3">Encherir</button>
                        </div>
                       
                    </div>
                            
                     
                        <div id="errordiv" style="color:red;margin-left: 6px;"><?php echo $msgErreur ?></div>
                    </form>
                <?php else : ?>  
                    <button onclick="location.href='Utilisateur/connexion.php'" type="button" class="btn btn-success">Connectez vous pour proposer une meilleure offre</button>
                <?php endif; ?>
            <?php else : ?>  
                <p style="color:red;margin-top:10px;margin-bottom:0px;">L'enchère est finie!</p>
            <?php endif; ?>



        <?php elseif($typeArticle==2) : ?>
            <div style="margin-top:10px;margin-bottom:3px;">Article en vente par négociation</div>
            <div style="margin-top:10px;margin-bottom:3px;">Prix de base du vendeur: <?php echo $article[0]['prixBase'] ?>€</div>


            
        <?php endif; ?>
       

        

    </div>

<?php endif; ?>

<script src="script_js/validationForm.js"></script>
