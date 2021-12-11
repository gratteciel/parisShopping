<?php 
    include('../../bdd/donneeSession.php');
    include('../../bdd/connectBDD.php');
    include('../Quantite/checkQuantite.php');

    $articlesAVendre= requeteSqlArray("SELECT idArticle,quantite,nom from article where vendeurId = {$_SESSION['idVendeur']}", $pdo);

    foreach($articlesAVendre as $a){
        $valeurCategorie = $_POST["categorie".$a['idArticle']];
        $valeurModifStock = $_POST["ajouter".$a['idArticle']];
        
        if($a['quantite']+$valeurModifStock<0)
            $valeurModifStock=-$a['quantite'];
   
        requeteSqlArray("UPDATE article SET categorie = '{$valeurCategorie}', quantite=quantite+$valeurModifStock where vendeurId = {$_SESSION['idVendeur']} and idArticle = {$a['idArticle']}", $pdo);
        
        $newQuantity= requeteSqlArray("SELECT quantite from article where vendeurId = {$_SESSION['idVendeur']} and idArticle = {$a['idArticle']}", $pdo);
      
        checkQuantiteNotification($a['idArticle'],$a['nom'],$newQuantity[0]['quantite'],$a['quantite'],$pdo);
        
    }

    date_default_timezone_set('Europe/Paris');
    $date = date('Y-m-d H:i:s', time());
    //Création d'une notification
    requeteSqlArray("INSERT INTO notification (nom,descriptionNotif,dateNotif,idUtilisateur,vu,lien) values ('Vendeur - modification articles','Vous avez bien modifié les articles que vous vendez','{$date}','{$_SESSION['idUtilisateur']}',0,'vendeur&affichage=block');",$pdo);

    header('Location: ../../index.php?page=vendeur&alerts=1&tA=modifArticles&valA=rien&affichage=block');
    exit();

?>