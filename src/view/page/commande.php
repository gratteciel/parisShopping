<?php


    $commande;
     if(isset($_GET['id'])){
        //Que avec article immediat
        $commande = requeteSqlArray("SELECT * from commandeLog where idCommandeLog = '{$_GET['id']}' and utilisateurId = '{$_SESSION['idUtilisateur']}'",$pdo);
        
        if(sizeof($commande)==1 ){
            $paiementLog = requeteSqlArray("SELECT * from paiementLog WHERE idCommandeLog = '{$commande[0]['idCommandeLog']}'",$pdo);
            $adresseLog = requeteSqlArray("SELECT * from adresseLog WHERE idCommandeLog = '{$commande[0]['idCommandeLog']}'",$pdo);

            $articlesLog;

            $totalPrix=0;
        
            $articlesLog = requeteSqlArray("SELECT * from articleLog WHERE commandeLogId = '{$commande[0]['idCommandeLog']}'",$pdo);
            $articles;
            foreach($articlesLog as $a){
                $articles[$a['idArticleLog']] = requeteSqlArray("SELECT * from article WHERE idArticle = '{$a['articleId']}'",$pdo);
                $totalPrix+=$a['prixAchat'];
            }
       
        }
        

    }    
        

     
?>

<?php if(!isset($_GET['id']) ||sizeof($commande)==0 || sizeof($commande)>1 || !LOGGED) : ?>
    <div class="d-flex justify-content-center text-danger">Aucune commande trouvée</div>

<?php else : ?>
    <div class="alert alert-secondary" >
        <div>Référence de la commande : <?php echo $commande[0]['idCommandeLog'] ;?></div>
        <div>Date de la commande : <?php echo $commande[0]['dateCommande'] ?></div>
      

        <div class="flexEspaceEntre" style="margin-top:20px;">
            <h2 >Nombre d'articles: <?php echo count($articlesLog); ?> (<?php echo $totalPrix; ?>€)</h2>
            
            <div>
         
                <button id="afficherArticles" type="button" style="color:white" class="btn btn-secondary " onclick="afficherOuPas('articlesLogs')">Les afficher</button></h1>
            

            </div>
        </div>
            


    
        <div id="articlesLogs" style="display:none;margin:3%;margin-top:5px;">

            <table class="table table-striped">
                <thead>
                    <tr>
                        <th scope="col">Nom</th>
                        <th scope="col">Prix d'achat</th>
                        <th scope="col" style="width:1%;">Afficher</th>
                    </tr>
                </thead>
                <tbody>

                    <?php foreach ($articlesLog as $article): ?>
                            
                            <tr>
                                <?php
                                echo "<td>". $articles[$article['idArticleLog']][0]['nom'] ."</td>";
                                echo "<td>". $article['prixAchat'] ."</td>";
                                echo "<td style='width:1%;'>";
                                ?>
                        
                                <button onclick="location.href='index.php?page=article&id=<?php echo $articles[$article['idArticleLog']][0]['idArticle'] ?>'" type="button" class="btn btn-warning">Afficher</button>
                            
                                <?php echo "</td>"?> 
                            </tr>
                        </ul>
                    <?php endforeach; ?>


                </tbody>
            </table>
        </div>
   <hr>
            <h2 class="text" style='margin-top:40px;'>Moyen de paiement :</h2>
            
        
            



        <div id="paiementAffichage" style="margin:3%;margin-top:0px;">

            <table class="table table-striped"  >
                <thead>
                    <tr>
                        <th scope="col">Type</th>
                        <th scope="col">Numéro</th>
                        <th scope="col">Nom</th>
                        <th scope="col">Date d'expiration</th>
                    </tr>
                </thead>
                <tbody>

               
                            <tr>
                                <?php
                                echo "<td>". $paiementLog[0]['typeCarte'] ."</td>";
                                echo  "<td>****-****-****-" . substr($paiementLog[0]['numeroCarte'], -4)."</td>";
                            
                                echo "<td>". $paiementLog[0]['nomCarte']."</td>";
                                echo "<td>".  $paiementLog[0]['dateExpiration']."</td>";
                                
               
                                ?>
                            </tr>
               
                


                </tbody>
            </table>
        </div>

        <h2 class="text" style='margin-top:40px;'>Adresse de livraison :</h2>

        <div id="adresseAffichage" style="margin:3%;margin-top:0px;margin-bottom:0px;">

            <table class="table table-striped"  >
                <thead>
                    <tr>
                    <th scope="col">Numéro</th>
                    <th scope="col">Rue</th>
                    <th scope="col">Ville</th>
                    <th scope="col">Pays</th>
                    <th scope="col">Nom</th>
                    </tr>
                </thead>
                <tbody>

               
                            <tr>
                                <?php
                                echo "<td>". $adresseLog[0]['numeroVoie'] ."</td>";
                                echo  "<td>" . $adresseLog[0]['rue']."</td>";
                                echo "<td>". $adresseLog[0]['ville'].", " . $adresseLog[0]['codePostal']."</td>";
                                echo "<td>". $adresseLog[0]['pays']."</td>";
                                echo "<td>".  $adresseLog[0]['nom']."</td>";
                                
               
                                ?>
                            </tr>
               
                


                </tbody>
            </table>
        </div>
     </div>
    

<?php endif; ?>
