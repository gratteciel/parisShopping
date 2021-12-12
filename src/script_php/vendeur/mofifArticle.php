<?php 
    include('../../bdd/donneeSession.php');
    include('../../bdd/connectBDD.php');
    include('../Quantite/checkQuantite.php');

    $articlesAVendre= requeteSqlArray("SELECT * from article a, articleimmediat ai where vendeurId = {$_SESSION['idVendeur']} and a.idArticle = ai.idArticle", $pdo);

    foreach($articlesAVendre as $a){
        $valeurCategorie = $_POST["categorie".$a['idArticle']];
        $valeurModifStock = $_POST["ajouter".$a['idArticle']];
        $valeurNouveauPrix = $_POST["prixNouveau".$a['idArticle']];

        if($valeurModifStock<0)
            $valeurModifStock=0;

        if($valeurNouveauPrix<0)
            $valeurNouveauPrix=0;
   
        requeteSqlArray("UPDATE article SET categorie = '{$valeurCategorie}' where vendeurId = {$_SESSION['idVendeur']} and idArticle = {$a['idArticle']}", $pdo);
        
        requeteSqlArray("UPDATE articleimmediat SET  quantite={$valeurModifStock}, prixActuel = {$valeurNouveauPrix} where idArticle = {$a['idArticle']}", $pdo);

      
        checkQuantiteNotification($a['idArticle'],$a['nom'],$valeurModifStock,$a['quantite'],$pdo);
        
    }

    date_default_timezone_set('Europe/Paris');
    $date = date('Y-m-d H:i:s', time());
    //Création d'une notification
    requeteSqlArray("INSERT INTO notification (nom,descriptionNotif,dateNotif,idUtilisateur,vu,lien) values ('Vendeur - modification articles','Vous avez bien modifié les articles que vous vendez','{$date}','{$_SESSION['idUtilisateur']}',0,'vendeur&affichage=block&ou=1');",$pdo);

    header('Location: ../../index.php?page=vendeur&alerts=1&tA=modifArticles&valA=rien&affichage=block&ou=1');
    exit();

?>