<?php 

    $displayTableau='none';
if(LOGGED){
        if($_SESSION['estAdmin']){
            if(isset($_REQUEST['affichage'])){
                $displayTableau='block';
            }
            $allUsers= requeteSqlArray("SELECT * from utilisateur", $pdo);
            //Toutes les enchères qui ont une date de fin inférieur à celle actuelle 
            // (quand il faut s'en occuper et désigner qui a la meilleure offre)
            $articleEnchereASoccuper=requeteSqlArray("SELECT * from articleenchere where fini=0 and dateFin< NOW() ", $pdo);
           

            foreach($articleEnchereASoccuper as $a){

                $result = requeteSqlArray("SELECT * from enchere where idArticleEnchere = {$a['idArticleEnchere']} ORDER BY prixMax DESC", $pdo);

                $winner[$a["idArticleEnchere"]]=null;
                $userWinner[$a["idArticleEnchere"]]=null;
                if(isset($result[0])){
                    $winner[$a["idArticleEnchere"]]=$result[0];
                    $idUtilisateurWinner=$winner[$a["idArticleEnchere"]]['idUtilisateur'];
                    $userWinner[$a["idArticleEnchere"]] = requeteSqlArray("SELECT * from utilisateur where idUtilisateur = {$idUtilisateurWinner} ", $pdo);
                   
                }
                    
                
                

                $prixDeuxieme[$a["idArticleEnchere"]]=null;
                if(isset($result[1]))
                    $prixDeuxieme[$a["idArticleEnchere"]]=$result[1];
                
                
                
                
                
            }
            
        }
    }
?>



<?php if (LOGGED): ?>
    
    <?php if ($_SESSION['estAdmin'] == 0): ?>
        <div class="d-flex justify-content-center text-danger">Vous n'etes pas administrateur!</div>

    <?php else: ?>
        <h1 style="color: white" class="display-4 fw-normal text-center">Pannel Administrateur</h1>
        <hr>
        <div class="flexEspaceEntre">
            <h2 class="text-light">Tous les utilisateurs (<?php echo count($allUsers); ?>)</h2>
            
            <div>
                <?php if(sizeof($allUsers)!=0) : ?>
                    <button id="afficherPaie" type="button" style="color:white" class="btn btn-outline-secondary " onclick="afficherOuPas('utilisateurTableau')">Les afficher</button></h1>
                <?php endif; ?>

            </div>
        </div>
                    



                <div id="utilisateurTableau" style="display:<?php echo $displayTableau?>;margin:3%;">
                <form action="script_php/admin/modifVendeur.php" method="post">
                    <div >
                    <table class="table table-bordered"  style="color:white;">
                        <thead>
                            <tr>
                                <th scope="col">Id</th>
                                <th scope="col">pseudo</th>
                                <th scope="col">Nom</th>
                                <th scope="col">Prénom</th>
                                <th scope="col">mail</th>
                                <th scope="col">Vendeur?</th>
                                
                     
                            </tr>
                        </thead>
                        <tbody>

                            <?php foreach ($allUsers as $user): ?>
                                
                                    <tr>
                                        <?php
                                        echo "<td>". $user['idUtilisateur'] ."</td>";
                                        echo "<td>". $user['pseudo'] ."</td>";
                                        echo "<td>". $user['nom'] ."</td>";
                                        echo "<td>". $user['prenom'] ."</td>";
                                        echo "<td>". $user['mail'] ."</td>";
                                        ?>
                                        <td><input class='form-check-input' type='checkbox' value='' id='estVendeurModif<?php echo$user['idUtilisateur']?>' 
                                        name='estVendeurModif<?php echo$user['idUtilisateur']?>' 
                                        <?php
                                        if($user['estVendeur'])
                                            echo "checked";
                                        ?>
                                        >
                                        </td>
                                        

                                      
                                    </tr>
                                </ul>
                            <?php endforeach; ?>


                        </tbody>
                    </table>
                    
                    <div style="display:flex;justify-content:center;align-items:center">
                            <button  style="text-center" type="submit" name="submit" class="btn btn-warning" >Modifier</button>
                        </div>
                        </div>
                </form>
        </div>
        <hr>
        <div class="flexEspaceEntre">
            <h2 class="text-light">Enchères à finaliser (<?php echo count($articleEnchereASoccuper); ?>)</h2>
            
            <div>
                <?php if(sizeof($articleEnchereASoccuper)!=0) : ?>
                    <button id="afficherPaie" type="button" style="color:white" class="btn btn-outline-secondary " onclick="afficherOuPas('enchereTableau')">Les afficher</button></h1>
                <?php endif; ?>

            </div>
        </div>

        <div id="enchereTableau" style="display:<?php echo $displayTableau?>;margin:3%;">
                <form action="script_php/admin/accepterEnchere.php" method="post">
                    <div >
                    <table class="table table-bordered"  style="color:white;">
                        <thead>
                            <tr>
                                <th scope="col">Id (articleEnchere)</th>
                                <th scope="col">Date de début</th>
                                <th scope="col">Date de fin</th>
                                <th scope="col">Id de l'article</th>
                                <th scope="col">Id Utilisateur meilleure offre</th>
                                <th scope="col">Prix meilleure offre</th>
                                <th scope="col">Second prix meilleure offre</th>
                                <th scope="col">Prix à payer</th>
                                
                     
                            </tr>
                        </thead>
                        <tbody>

                            <?php foreach ($articleEnchereASoccuper as $e): ?>
                                
                                    <tr>
                                        <?php
                                        echo "<td>". $e['idArticleEnchere'] ."</td>";
                                        echo "<td>". $e['dateDebut'] ."</td>";
                                        echo "<td>". $e['dateFin'] ."</td>";
                                        echo "<td>". $e['idArticle'] ."</td>";
                                        if( $userWinner[$e["idArticleEnchere"]]==null){
                                            echo "<td>Aucune enchère</td>";
                                        }
                                        else{
                                            echo "<td>". $userWinner[$e["idArticleEnchere"]][0]['idUtilisateur'] . " (".$userWinner[$e["idArticleEnchere"]][0]['mail'] . ")</td>";
                                        }
                                        
                                        if( $winner[$e["idArticleEnchere"]]==null){
                                            echo "<td>Aucune enchère</td>";
                                        }else{
                                            echo "<td>". $winner[$e["idArticleEnchere"]]['prixMax'] ."€</td>";
                                        }
                                        

                                        if($prixDeuxieme[$e["idArticleEnchere"]]==null){
                                            echo "<td>Aucune deuxième enchère</td>";
                                        }
                                        else{
                                            echo "<td>". $prixDeuxieme[$e["idArticleEnchere"]]['prixMax'] ."€</td>";
                                        }
                                        if( $winner[$e["idArticleEnchere"]]==null){
                                            echo "<td>Aucune enchère</td>";
                                        }
                                        else{
                                            echo "<td>". strval($prixDeuxieme[$e["idArticleEnchere"]]['prixMax'] +1) ."€</td>";
                                        }
                                        
                                        ?>
                                        
                                        
                                        
                                        </td>
                                        

                                      
                                    </tr>
                                </ul>
                            <?php endforeach; ?>


                        </tbody>
                    </table>
                    
                    <div style="display:flex;justify-content:center;align-items:center">
                            <button  style="text-center" type="submit" name="submit" class="btn btn-warning" >Finaliser</button>
                        </div>
                        </div>
                </form>
        </div>
                            
    <?php endif; ?>
<?php else: ?>
    <div class="d-flex justify-content-center text-danger">Vous n'êtes pas connecté!</div>
<?php endif; ?>