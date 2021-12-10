<?php
    include_once PROJECT_ROOT_DIR . '/src/include/loginStatus.php';
    include_once PROJECT_ROOT_DIR . '/src/include/Utilisateur.php';

    $displayAdresse='none';
    $displayPaiement='none';   

    if (empty($idUtilisateur)) {
    // redirect to user login
    header('Location: Utilisateur/connexion.php');
    exit();
}

$addressList = Utilisateur::addressList($pdo, $idUtilisateur);
$cardList    = Utilisateur::cardList($pdo, $idUtilisateur);
$commandes = Utilisateur::commandes($pdo, $idUtilisateur);
$articlesLog;
foreach($commandes as $co){
    $articlesLog[$co['idCommandeLog']] = requeteSqlArray("SELECT * from articleLog WHERE commandeLogId = '{$co['idCommandeLog']}'",$pdo);
}

?>

<div class="Presentation_site p-3 pb-md-4 mx-auto text-center">
    <h1 style="color: white" class="display-4 fw-normal">Votre compte</h1>

</div>
<p class="text-light">Nom: <?php echo Utilisateur::afficherValeurSession('nom'); ?></p>
<p class="text-light">prenom: <?php echo Utilisateur::afficherValeurSession('prenom'); ?></p>
<p class="text-light">pseudo: <?php echo Utilisateur::afficherValeurSession('pseudo'); ?></p>
<p class="text-light">mail: <?php echo Utilisateur::afficherValeurSession('mail'); ?></p>


<hr>
<div class="flexEspaceEntre">
    <h2 class="text-light">Nombres d'adresses enregistrées : <?php echo count($addressList); ?></h2>
    
    <div>
    <?php if(sizeof($addressList)!=0) : ?>
        <button id="afficher" type="button" style="color:white" class="btn btn-outline-secondary " onclick="afficherOuPas('adresseAffichage')">Les afficher</button></h1>
    <?php endif; ?>
    <!-- Button trigger modal -->
    
    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
        Ajouter
    </button>
    </div>
</div>


    <?php $page='votre_compte'; include('html/ajouterAdresse.php');?>
    <?php include('html/ajouterPaiement.php');?>
<div id="adresseAffichage" style="display:<?php echo $displayAdresse?>;margin:3%;">

    <table class="table table-bordered"  style="color:white;">
    <thead>
        <tr>
        <th scope="col">Numéro</th>
        <th scope="col">Rue</th>
        <th scope="col">Ville</th>
        <th scope="col">Pays</th>
        <th scope="col">Nom</th>
        <th scope="col" style="width:1%;">Supprimer</th>
        </tr>
    </thead>
    <tbody>

    <?php foreach ($addressList as $adress): ?>
        <!--<ul class="ul_presentation_site"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-house" viewBox="0 0 16 16">
                <path fill-rule="evenodd"
                    d="M2 13.5V7h1v6.5a.5.5 0 0 0 .5.5h9a.5.5 0 0 0 .5-.5V7h1v6.5a1.5 1.5 0 0 1-1.5 1.5h-9A1.5 1.5 0 0 1 2 13.5zm11-11V6l-2-2V2.5a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5z"/>
                <path fill-rule="evenodd" d="M7.293 1.5a1 1 0 0 1 1.414 0l6.647 6.646a.5.5 0 0 1-.708.708L8 2.207 1.354 8.854a.5.5 0 1 1-.708-.708L7.293 1.5z"/>
            </svg>
            -->
            <tr>
                <?php
                echo "<td>". $adress['numeroVoie'] ."</td>";
                echo  "<td>" . $adress['rue']."</td>";
                echo "<td>". $adress['ville'].", " . $adress['codePostal']."</td>";
                echo "<td>". $adress['pays']."</td>";
                echo "<td>".  $adress['nom']."</td>";
                echo "<td style='width:1%;'>";
                ?>
                
                <button onclick="location.href='script_php/supprAdresse.php?idAdresse=<?php echo $adress['idAdresse']; ?>'" type="button" class="btn btn-danger">Supprimer</button>
             
                <?php echo "</td>"?>
            </tr>
        </ul>
    <?php endforeach; ?>
   
    
    </tbody>
    </table>
</div>


<hr>


<div class="flexEspaceEntre">
    <h2 class="text-light">Nombres de moyens de paiement enregistrés : <?php echo count($cardList); ?></h2>
    
    <div>
    <?php if(sizeof($cardList)!=0) : ?>
        <button id="afficherPaie" type="button" style="color:white" class="btn btn-outline-secondary " onclick="afficherOuPas('paiementAffichage')">Les afficher</button></h1>
        <?php endif; ?>
        <!-- Button trigger modal -->
        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal2">
        Ajouter
        </button>
    </div>
</div>
    



<div id="paiementAffichage" style="display:<?php echo $displayPaiement?>;margin:3%;">

    <table class="table table-bordered"  style="color:white;">
        <thead>
            <tr>
                <th scope="col">Type</th>
                <th scope="col">Numéro</th>
                <th scope="col">Nom</th>
                <th scope="col">Date d'expiration</th>
                <th scope="col" style="width:1%;">Supprimer</th>
            </tr>
        </thead>
        <tbody>

            <?php foreach ($cardList as $card): ?>
                    <tr>
                        <?php
                        echo "<td>". $card['typeCarte'] ."</td>";
                        echo  "<td>****-****-****-" . substr($card['numeroCarte'], -4)."</td>";
                     
                        echo "<td>". $card['nomCarte']."</td>";
                        echo "<td>".  $card['dateExpiration']."</td>";
                        
                        echo "<td style='width:1%;'>";
                        ?>
                
                        <button onclick="location.href='script_php/supprPaiement.php?idPaiement=<?php echo $card['idPaiement']; ?>'" type="button" class="btn btn-danger">Supprimer</button>
                    
                        <?php echo "</td>"?>
                    </tr>
                </ul>
            <?php endforeach; ?>


        </tbody>
    </table>
</div>

<hr>


<div class="flexEspaceEntre">
    <h2 class="text-light">Historiques des commandes: <?php echo count($commandes); ?></h2>
    
    <div>
    <?php if(sizeof($commandes)!=0) : ?>
        <button id="afficherPaie" type="button" style="color:white" class="btn btn-outline-secondary " onclick="afficherOuPas('historiqueCommande')">Les afficher</button></h1>
        <?php endif; ?>

    </div>
</div>
    



<div id="historiqueCommande" style="display:<?php echo $displayPaiement?>;margin:3%;">

    <table class="table table-bordered"  style="color:white;">
        <thead>
            <tr>
                <th scope="col">Référence de la commande</th>
                <th scope="col">Date de la commande</th>
                <th scope="col">Nombre d'articles</th>
                <th scope="col" style="width:1%;">Afficher</th>
            </tr>
        </thead>
        <tbody>

            <?php foreach ($commandes as $co): ?>
                
                    <tr>
                        <?php
                        echo "<td>". $co['idCommandeLog'] ."</td>";
                        echo "<td>". $co['dateCommande'] ."</td>";
                        echo  "<td>" . sizeof($articlesLog[$co['idCommandeLog']])."</td>";
                        echo "<td style='width:1%;'>";
                        ?>
                
                        <button onclick="location.href='index.php?page=commande&id=<?php echo $co['idCommandeLog']; ?>'" type="button" class="btn btn-warning">Afficher</button>
                    
                        <?php echo "</td>"?> 
                    </tr>
                </ul>
            <?php endforeach; ?>


        </tbody>
    </table>
</div>

<script src="script_js/validationForm.js"></script>
