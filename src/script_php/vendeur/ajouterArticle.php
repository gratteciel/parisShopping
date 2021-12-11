<?php 
include('../../bdd/donneeSession.php');
include('../../bdd/connectBDD.php');
if(isset($_POST["submit"])) {
    $message="";
    $erreur=0;
    if($_POST['nomModif']=="" || $_POST['categorieModif']=="" || empty($_FILES) || $_POST['typeModif']=="")
        $erreur++;
    if(!is_numeric($_POST['quantiteModif']))
        $erreur++;
    else if(intval($_POST['quantiteModif'])<0)
        $erreur++;

    if($_POST['typeModif']=="achatImm" ||$_POST['typeModif']=="nego" ){
        if($_POST['prixModif']==""){
            $erreur++;
            $message="Vous n'avez pas inséré de prix";
        }
        else if(!is_numeric($_POST['prixModif'])){
            $erreur++;
            $message="Le prix doit etre un entier!";
        }
            
        else if(intval($_POST['prixModif'])<0){
            $message="Le prix doit etre un entier positif!";
            $erreur++;
        }
            
    }
    

    //concernant la photo principale / source = https://www.w3schools.com/PHP/php_file_upload.asp
    $enregistrer = "images_articles/" .basename($_FILES["photoPrincipaleModif"]["name"]);
    $target_dir = "../../../images_articles/";
    $target_file = $target_dir . basename($_FILES["photoPrincipaleModif"]["name"]);
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
    // Check if image file is a actual image or fake image

    $check = getimagesize($_FILES["photoPrincipaleModif"]["tmp_name"]);
    if($check !== false) {
        $uploadOk = 1;
    } else {
        $erreur++;
        $uploadOk = 0;
        $message="Aucune image n'a été upload :(";
    }
    if($uploadOk==1){
        if (move_uploaded_file($_FILES["photoPrincipaleModif"]["tmp_name"], $target_file)) {
            echo "The file ". htmlspecialchars( basename( $_FILES["photoPrincipaleModif"]["name"])). " has been uploaded.";
       } else {
           $erreur++;
           $message="Problème sur le chargement de l'image";
       }
    }
    

    if($erreur==0){
        
        //Ajout dans a table article
        requeteSqlArray("INSERT INTO article (nom,description,quantite,nombreVendu,categorie,photoPrincipale,vendeurId) values ('{$_POST['nomModif']}','{$_POST['descriptionModif']}','{$_POST['quantiteModif']}',0,'{$_POST['categorieModif']}','{$enregistrer}','{$_SESSION['idVendeur']}');",$pdo);
        $idArticle=requeteSqlArray("SELECT LAST_INSERT_ID();",$pdo);
      

        if($_POST['typeModif']=="achatImm"){ //Si achat immédiat
            requeteSqlArray("INSERT INTO articleimmediat (prixActuel,idArticle) values ('{$_POST['prixModif']}','{$idArticle[0]['LAST_INSERT_ID()']}');",$pdo);
        }
        
        date_default_timezone_set('Europe/Paris');
        $date = date('Y-m-d H:i:s', time());
        //Création d'une notification
        requeteSqlArray("INSERT INTO notification (nom,descriptionNotif,dateNotif,idUtilisateur,vu,lien) values ('Vendeur - Ajout article','Vous avez bien ajouté {$_POST['nomModif']}','{$date}','{$_SESSION['idUtilisateur']}',0,'article&id={$idArticle[0]['LAST_INSERT_ID()']}');",$pdo);


        header('Location: ../../index.php?page=vendeur&alerts=1&tA=ajoutArticleVendeur&valA=rien');
        exit();
    }
    else{
        header('Location: ../../index.php?page=vendeur&err=1&msg='.$message);
        exit();
    }

    
}
?>