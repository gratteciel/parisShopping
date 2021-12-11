<?php 
    $ouvrirModal=false;
    if(LOGGED) {
        if($_SESSION['estVendeur']){
            $msgErreur="";
            $articlesAVendre= requeteSqlArray("SELECT * from article where vendeurId = {$_SESSION['idVendeur']}", $pdo);
            $displayArticles='none';   
            if(isset($_REQUEST['affichage'])){
                $displayArticles=$_REQUEST['affichage']; 
            }
            if(isset($_REQUEST['err']) && isset($_REQUEST['msg'])){
                $msgErreur=$_REQUEST['msg'];
               $ouvrirModal=true;
            }
            
              
        }
    }
    
    
    
    
?>




<?php if(!LOGGED ) : ?>
    <div class="d-flex justify-content-center text-danger">Vous n'êtes pas connecté!</div>
    <?php elseif(!$_SESSION['estVendeur']) : ?>
    <div class="d-flex justify-content-center text-danger">Vous n'avez pas les droits!</div>

<?php else : ?>
      <!-- Modal -->
  <div style="color:black" class="modal fade" id="modalAjoutArticle" tabindex="-1" aria-labelledby="modalAjoutArticleLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title"  id="modalAjoutArticleLabel">Ajouter un article</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <form action="script_php/vendeur/ajouterArticle.php" method="post" onsubmit = "return validateForm('ajoutArticle',['nomModif','quantiteModif','categorieModif','typeModif'],'errordiv')" enctype="multipart/form-data">
              <div id='form-mod'>
                  <div style="display:flex;flex-direction:row">
                        <input type="text" 
                                    class="form-control form-mod" 
                                id='nomModif'
                                placeholder="Nom"
                                name="nomModif"
                                >
                        <input type="number" 
                            class="form-control form-mod" 
                            placeholder="Quantité"
                            style="width:30%"
                            name="quantiteModif"
                            id="quantiteModif">

                    </div>
                    <div style="display:flex;flex-direction:row">
                        <select name="categorieModif" id="categorieModif" class="form-select  form-mod"aria-label="Default select example" >     
                                <option value="régulier" selected>régulier</option>
                                <option value="rare">rare</option>
                                <option value="haut de gamme">haut de gamme</option>
                        </select>
                        <input type="number" 
                            class="form-control form-mod" 
                            placeholder="Prix"
                            style="width:30%"
                            name="prixModif"
                            
                        id="prixModif"
                        tabindex="1" data-bs-toggle="popover" data-bs-trigger="hover focus"  data-bs-content="Pour achat immédiat : prix de vente 
                        /Pour négociation : prix de base 
                        /Pour meilleure offre : inutile" data-html="true">
                    </div>
                    <select name="typeModif" id="typeModif" class="form-select  form-mod"aria-label="Default select example" >     
                            <option value="achatImm" selected>Achat immédiat</option>
                            <option value="nego">Négociation</option>
                            <option value="meilleure">Meileure offre</option>
                    </select>
    
  
                
                      <textarea  
                              class="form-control form-mod" 
                              id='descriptionModif'
                          placeholder="Description"
                          name="descriptionModif"
                          row="3"
                          ></textarea>
  
                         
                        <label for="photoPrincipaleModif" class="form-label  form-mod" style="margin-bottom:0px">La photo principale</label>
                        <input class="form-control  form-mod" type="file" name="photoPrincipaleModif" id="photoPrincipaleModif">
                        
              </div>
              <div id="errordiv" style="color:red;margin-left: 6px;"><?php echo $msgErreur; ?></div>
        </div>
        
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fermer</button>
          <button type="submit" name="submit" id="submit"  class="btn btn-primary">Ajouter</button>
        </div>
        </form>
      </div>
    </div>
  </div>



    <div class="Magasin p-3 pb-md-4 mx-auto text-center">
        <h1 style="color: white" class="display-4 fw-normal">Pannel Vendeur</h1>
        <div class="flexEspaceEntre" style='margin-top:40px;'>
    <h2 class="text-light" >Nombre d'articles que vous vendez: <?php echo count($articlesAVendre); ?></h2>
    
    <div>
        <?php if(sizeof($articlesAVendre)!=0) : ?>
            <button id="afficherPaie" type="button" style="color:white" class="btn btn-outline-secondary " onclick="afficherOuPas('articlesAVendre')">Les afficher</button></h1>
            <?php endif; ?>
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalAjoutArticle">
                Ajouter
            </button>

        </div>
    </div>
        



    <div id="articlesAVendre" style="display:<?php echo $displayArticles?>;margin:3%;">

        
            

                    <form action="script_php/vendeur/mofifArticle.php" method="post" style="display:flex;flex-direction:column;justify-content: center;">
                        <div >
                        <table class="table table-bordered"  style="color:white;">
                            <thead>
                                <tr>
                                    <th scope="col">Id de l'article</th>
                                    <th scope="col">Nom</th>
                                    <th scope="col"  style="width:18%">Catégorie</th>
                                    <th scope="col">Nombre vendu</th>
                                    <th scope="col">Quantite</th>
                                    <th scope="col"  tabindex="0" data-bs-toggle="popover" data-bs-trigger="hover focus"  data-bs-content="Mettre un nombre positif pour augmenter et un nombre négatif pour baisser la quantité">Ajouter/Enlever ?</th>
                                
                                </tr>
                            </thead>
                            <tbody>
                            <?php foreach ($articlesAVendre as $a): ?>
                                    <tr>
                                        <?php
                                        echo "<td><a href='index.php?page=article&id=". $a['idArticle']."'>". $a['idArticle'] ."</a></td>";
                                        echo "<td><a href='index.php?page=article&id=". $a['idArticle']."'>". $a['nom'] ."</a></td>";
                                        echo "<td>" ?>
                                        <select name="categorie<?php echo $a['idArticle'] ?>" class="form-select"aria-label="Default select example">
                                            <?php if($a['categorie']=="régulier") : ?>
                                                <option value="régulier" selected>régulier</option>
                                            <?php else : ?>
                                                <option value="régulier">régulier</option>
                                            <?php endif; ?>
                                            <?php if($a['categorie']=="rare") : ?>
                                                <option value="rare" selected>rare</option>
                                            <?php else : ?>
                                                <option value="rare">rare</option>
                                            <?php endif; ?>
                                            <?php if($a['categorie']=="haut de gamme") : ?>
                                                <option value="haut de gamme" selected>haut de gamme</option>
                                            <?php else : ?>
                                                <option value="haut de gamme">haut de gamme</option>
                                            <?php endif; ?>
                                        </select>
                                        <?php
                                        echo "</td><td>". $a['nombreVendu'] ."</td>";
                                        echo "<td>". $a['quantite'] ."</td>";
                                        echo "<td style='width:15%;'><input style='width:60%;' type='number' name='ajouter".  $a['idArticle']."' value='0'></td>";
                                
                                        
                                        ?>
        
                                    </tr>
                                </ul>
                            <?php endforeach; ?>
                                </tbody>
                             </table>
                        </div>
                        <div>
                            <button  type="submit" name="submit" class="btn btn-warning" >Modifier les articles</button>
                        </div>
                </form>
                    
              
           
    </div>

    </div>


<?php endif; ?>
<?php if($ouvrirModal): ?>
    <script type="text/javascript">
    $(window).load(function(){        
    $('#modalAjoutArticle').modal('show');
        }); 

    </script>
<?php endif; ?>
<script src="script_js/validationForm.js"></script>
