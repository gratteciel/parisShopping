<?php
include_once PROJECT_ROOT_DIR . '/src/include/loginStatus.php';
include_once PROJECT_ROOT_DIR . '/src/include/Utilisateur.php';
    date_default_timezone_set('Europe/Paris');
    $date = date('Y-m-d H:i:s', time());
    $msgErreur="";
    $article;
    $vendeurConnecte=false;
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
        $photo = requeteSqlArray("SELECT * from photo where idLiaisonTable = '{$_GET['id']}'", $pdo);
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
            else if($article[0]['idArticleNegociation']!=null){//article négociation
                $article = requeteSqlArray("SELECT * from article a, articlenegociation an where a.idArticle = an.idArticle and a.idArticle = '{$_GET['id']}'",$pdo);
                $negociation = requeteSqlArray("SELECT * from negociation where idArticleNegociation='{$article[0]['idArticleNegociation']}'",$pdo);

                $negociationNbUtilisateur =requeteSqlArray("SELECT COUNT(DISTINCT n.idUtilisateur) from negociation n where idArticleNegociation='{$article[0]['idArticleNegociation']}' and (accepted=0 and (select COUNT(*) from negociation where idUtilisateur = n.idUtilisateur) <5)",$pdo);


                if(LOGGED){
                    $prochaineNego=true;
                    $vousAvezLarticle=false;
                    $vendeurPasOkAvecVotrePrix=false;
                    $negociationWithUser =requeteSqlArray("SELECT * from negociation where idArticleNegociation='{$article[0]['idArticleNegociation']}' and idUtilisateur = {$_SESSION['idUtilisateur']} ORDER BY dateNegocUser DESC",$pdo);
                    $tailleNegoWithUser =sizeof($negociationWithUser);



                    if(sizeof($negociationWithUser)>0){
                        if($negociationWithUser[0]['traiter']==0 && $negociationWithUser[0]['accepted']==0){
                            $prochaineNego=false;
                            $prixNegoc= $negociationWithUser[0]['prixUser'];
                        }
                        else if($negociationWithUser[0]['traiter']==1 && $negociationWithUser[0]['accepted']==0 )
                        {
                            if($tailleNegoWithUser<5){
                                $prochaineNego=true;
                                $vendeurPasOkAvecVotrePrix=true;
                                
                            }
                            else{
                                $prochaineNego=false;
                                $vendeurPasOkAvecVotrePrix=true;
                            }
                            $prixNegoc= $negociationWithUser[0]['prixUser'];
                            $contreOffre= $negociationWithUser[0]['contreOffre'];
                            
                        }
                        else if($negociationWithUser[0]['traiter']==1 && $negociationWithUser[0]['accepted']==1 ){
                            $prixNegoc= $negociationWithUser[0]['prixUser'];
                            $vousAvezLarticle=true;
                            $prochaineNego=false;
                        }
                        
                    }
                    
                    $vendeurConnecte=false;
                    //Si c'est le vendeur
                    if($_SESSION['estVendeur']){
                    
                        if($_SESSION['idVendeur']==$article[0]['vendeurId']){
                            $vendeurConnecte=true;
                            $negociationATraiter = requeteSqlArray("SELECT * from negociation where idArticleNegociation='{$article[0]['idArticleNegociation']}' and traiter=0",$pdo);
                            
                            $userNegoATraiter;
                            foreach($negociationATraiter as $n){
                                $userNegoATraiter[$n['idNegociation']] = requeteSqlArray("SELECT * from utilisateur where idUtilisateur = {$n['idUtilisateur']}",$pdo);
                            }
                           


                        }
                    }
                    
                    
                }
                

                
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
                    <form action="script_php/enchere/encherir.php?idArtEnchere=<?php echo $article[0]['idArticleEnchere']?>&idArticle=<?php echo $article[0]['idArticle']?>" method="post" style="margin-top:10px;margin-bottom:5px" onsubmit = "return validateForm('encherir',['prix'],'errordiv3')">
                   
                 
                            
                    <div style="display:flex;flex-direction:row;justify-content:space-around;margin-top:20px;">
                        <div style="width:10%;height:100%;margin-right:10px;">
                        <label style="margin-bottom: 5px;" for="prix">Votre prix</label>
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
                            
                     
                        <div id="errordiv3" style="color:red;margin-left: 6px;"><?php echo $msgErreur ?></div>
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
            
            

            
            <?php if($article[0]['fini']==0) : ?>
                <div style="margin-bottom:3px;"><?php echo $negociationNbUtilisateur[0]['COUNT(DISTINCT n.idUtilisateur)'];
                if($negociationNbUtilisateur[0]['COUNT(DISTINCT n.idUtilisateur)']>1)
                    echo " personnes";
                else
                    echo " personne";
            ?> en train de négocier avec le vendeur</div>

                <?php if(LOGGED) : ?>
                    <?php $page='article&id='.$article[0]['idArticle']; include('view/page/html/ajouterAdresse.php');?>
                    <?php include('view/page/html/ajouterPaiement.php');?>
                    <?php if($vousAvezLarticle) :?>
                        <p class="text-success" >Vous avez réussi à négocier avec le vendeur, rentrouvez l'article dans vos commandes</p>
                    <?php endif ?>
                    <?php if($vendeurPasOkAvecVotrePrix && $prochaineNego) : ?>
                        <p class="text-danger" style="margin-top:10px;margin-bottom:0px;">Le vendeur a examiné votre prix de négociation (<?php echo $prixNegoc ?>€) et ne l'a pas accepté, sa contre offre est : <?php echo $contreOffre ?>€</p>
                        <p class="text-success" >Vous avez encore <?php echo (5-sizeof($negociationWithUser)) ?> tentatives pour négocier: </p>
                    <?php elseif($prochaineNego==false
                                &&$vendeurPasOkAvecVotrePrix==true): ?>
                        <p class="text-danger" style="margin-top:10px;margin-bottom:0px;">Le vendeur a examiné votre prix de négociation (<?php echo $prixNegoc ?>€) et ne l'a pas accepté.</p>
                        <p class="text-danger" >Vous ne pouvez plus négocier, vous avez déjà négocié <?php echo (sizeof($negociationWithUser)) ?> fois avec le vendeur</p>
                        <?php $prochaineNego=false; ?>
                    <?php endif; ?>

                    <?php if($prochaineNego) : ?>
                    <form action="script_php/negocier/negocier.php?idArtNegociation=<?php echo $article[0]['idArticleNegociation']?>&idArticle=<?php echo $article[0]['idArticle']?>" method="post" style="margin-top:10px;margin-bottom:5px" onsubmit = "return validateForm('encherir',['prix'],'errordiv3')">
                   
                 
                            
                    <div style="display:flex;flex-direction:row;justify-content:space-around;margin-top:20px;">
                        <div style="width:10%;height:100%;margin-right:10px;">
                        <label style="margin-bottom: 5px;" for="prix">Votre prix</label>
                                    <input  class="form-control" type="number" name="prix" id="prix">
                                </div>    
                        <div>
                            <label style="margin-bottom: 5px;" for="adressePayer">Adresse de livraison</label>
                            <a href="" data-bs-toggle="modal" data-bs-target="#exampleModal" class='aAjouter'>
                            (Ajouter)
                            </a>
                            
                            <select name="adressePayer" id="adressePayer" class="form-select col" style="width:250px" tabindex="0" data-bs-toggle="popover" data-bs-trigger="hover focus"  data-bs-content="Si votre prix d'achat est accepté par le vendeur, l'article sera livré à cet adresse" data-html="true"  data-bs-placement="bottom">
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
                            <select name="paiementPayer" id="paiementPayer" class="form-select col" style="width:250px" tabindex="1" data-bs-toggle="popover" data-bs-trigger="hover focus"  data-bs-content="Si votre prix d'achat est accepté par le vendeur, l'article sera payé avec les informations de cette carte" data-html="true"  data-bs-placement="bottom">
                            

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
                            <button  style="margin-top:35%" type="submit" name="submit" class="btn btn-primary mb-3">Négocier</button>
                        </div>
                       
                    </div>
                            
                     
                        <div id="errordiv3" style="color:red;margin-left: 6px;"><?php echo $msgErreur ?></div>
                    </form>
                    <?php elseif($vendeurPasOkAvecVotrePrix==false && $vousAvezLarticle==false): ?>
                        <p class="text-success" style="margin-top:10px;margin-bottom:0px;">Vous avez déjà proposé une négociation (<?php echo $prixNegoc ?>€) et elle n'a pas encore été traité par le vendeur</p>
                    <?php endif; ?>
                <?php else : ?>
                    <button onclick="location.href='Utilisateur/connexion.php'" type="button" class="btn btn-success">Connectez vous pour négocier</button>
                <?php endif; ?>
            <?php else : ?>
                <p style="color:red;margin-top:10px;margin-bottom:0px;">Article vendu</p>
            <?php endif; ?>
        <?php endif; ?>
       

        

    </div>
    <div id="carouselExampleCaptions" style="margin: auto" class="carousel slide w-50" data-bs-ride="carousel">
        <div class="carousel-inner">
            </br> </br>
            <div class="carousel-item active">
                <img style="height: 600px;" src="../<?php echo $article[0]['photoPrincipale']; ?>"
                     class="d-block w-100" >
            </div>
            <?php foreach ($photo as $index => $productInfo): ?>
                <div class="carousel-item <?php if (0 == $index): ?><?php endif; ?>">
                    <img style="height: 600px;" src="../<?php echo $productInfo['lien']; ?>"
                         class="d-block w-100" >
                </div>

            <?php endforeach; ?>
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
    </div>
    <?php if($vendeurConnecte && $typeArticle==2) :?>
   
      
        
            <div style='margin-top:70px'>
            <hr>
            <h1 class="text-danger" >Pannel Vendeur</h1>
            <hr>
            <div class="text-center" >
                <?php if(sizeof($negociationATraiter)!=0) : ?>
                    <button id="afficherPaie" type="button" style="color:white;float:right;" class="btn btn-outline-secondary "  onclick="afficherOuPas('negoATraiter') ">Les afficher</button></h1>
                <?php endif; ?>
                <h2 class="text-light" ><?php  echo count($negociationATraiter) ?> négociations à traiter :</h1>
                </div>
            </div>
            <div id="negoATraiter" class="text-center" style="display:none;margin:3%;">

                
                    

                            
                                <div style="display:flex;flex-direction:column;justify-content: center;">
                                <table class="table table-bordered"  style="color:white;">
                                    <thead>
                                        <tr>
                                          
                                            
                                            <th scope="col" >Utilisateur</th>
                                            <th scope="col">Date de la proposition</th>
                                            <th scope="col">Prix proposé</th>
                                            <th scope="col">Accepter/Contre offre</th>
                                            <th style="width:10%" scope="col">Prix de la contre offre</th>
                                            <th scope="col">Envoyer</th>
                                            
                                        
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php foreach ($negociationATraiter as $a): ?>
                                        
                                        <form action="script_php/vendeur/gestionNegoc.php?idArticleNegociation=<?php echo $article[0]['idArticleNegociation'];?>&idArticle=<?php echo $article[0]['idArticle'];?>" method="post" >
                                            <tr>
                                                <?php
                                                
                                                echo "<td>".$userNegoATraiter[$a['idNegociation']][0]['mail']."</td>";
                                                echo "<td>".$a['dateNegocUser']."</td>";

                                                echo "<td>".$a['prixUser']."€</td>";
                                                echo "<td>" ?>
                                                <select name="type<?php echo $a['idNegociation'] ?>" class="form-select"aria-label="Default select example">
                                                    
                                                        <option value="1" selected>Contre offre</option>
                                                    
                                                        <option value="2">Accepter</option>
                                                </select>
                                              
                                                </td>
                                                <td><input class="form-control" name="contreOffre<?php echo $a['idNegociation'] ?>" id="contreOffre<?php echo $a['idNegociation'] ?>" placeholder="Prix" type="number"></td>
                                                <td><button  type="submit" name="submit<?php echo $a['idNegociation'] ?>" class="btn btn-warning" >Envoyer</button></td>
                                            </tr>
                                        </ul>
                                        </form>
                                    <?php endforeach; ?>
                                        </tbody>
                                    </table>
                                </div>
                                <div>
                                
                                </div>
                        
                            
                    
                       
            </div>
            <hr>

    <?php endif; ?>

<?php endif; ?>

<script src="script_js/validationForm.js"></script>
