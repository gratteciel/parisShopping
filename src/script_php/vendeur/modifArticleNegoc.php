<?php 
    include('../../bdd/donneeSession.php');
    include('../../bdd/connectBDD.php');
    
    $articlesAVendre= requeteSqlArray("SELECT * from article a, articlenegociation an where vendeurId = {$_SESSION['idVendeur']} and a.idArticle = an.idArticle", $pdo);
   


    foreach($articlesAVendre as $a){

            $valeurCategorie = $_POST["categorie".$a['idArticle']];

    
           
            requeteSqlArray("UPDATE article SET categorie = '{$valeurCategorie}' where vendeurId = {$_SESSION['idVendeur']} and idArticle = {$a['idArticle']}", $pdo);
           
        
    }

    date_default_timezone_set('Europe/Paris');
    $date = date('Y-m-d H:i:s', time());
    //Création d'une notification
    requeteSqlArray("INSERT INTO notification (nom,descriptionNotif,dateNotif,idUtilisateur,vu,lien) values ('Vendeur - modification articles','Vous avez bien modifié les articles que vous vendez','{$date}','{$_SESSION['idUtilisateur']}',0,'vendeur&affichage=block&ou=3');",$pdo);

    header('Location: ../../index.php?page=vendeur&alerts=1&tA=modifArticles&valA=rien&affichage=block&ou=3');
    exit();

?>