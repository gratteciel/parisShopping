<?php 


function gestionsPhotos($idFile,$index,&$erreur,&$message){
     //concernant les autres photos / source = https://www.w3schools.com/PHP/php_file_upload.asp

     $target_dir = "../../../images_articles/";
     $target_file = $target_dir . basename($_FILES[$idFile]["name"][$index]);
     $uploadOk = 1;
     $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
     // Check if image file is a actual image or fake image
 
     if($_FILES[$idFile]["tmp_name"][$index]!=''){
        $check = getimagesize($_FILES[$idFile]["tmp_name"][$index]);
     }
     else{
         $erreur++;
         $message="Problème sur le chargement de " . $_FILES[$idFile]["name"][$index];
     }
     if($erreur==0){
        if($check !== false) {
            $uploadOk = 1;
        } else {
            $erreur++;
            $uploadOk = 0;
            $message=$_FILES[$idFile]["name"][$index] . " n'est pas une image";
        }
        if($uploadOk==1){
            if (move_uploaded_file($_FILES[$idFile]["tmp_name"][$index], $target_file)) {
                echo "The file ". htmlspecialchars( basename( $_FILES[$idFile]["name"][$index])). " has been uploaded.";
           } else {
               $erreur++;
               $message="Problème sur le chargement de " . $_FILES[$idFile]["name"][$index];
           }
        }
     }
     
     

}



include('../../bdd/donneeSession.php');
include('../../bdd/connectBDD.php');
if(isset($_POST["submit"])) {
    $message="";
    $erreur=0;
    if($_POST['nomModif']=="" || $_POST['categorieModif']=="" || empty($_FILES) || $_POST['typeModif']=="")
        $erreur++;

    if($_POST['typeModif']=="achatImm"){ //Si achat immédiat
        if($_POST['prixModifImm']==""){
            $erreur++;
            $message="Vous n'avez pas inséré de prix";
        }
        else if(!is_numeric($_POST['prixModifImm'])){
            $erreur++;
            $message="Le prix doit etre un entier!";
        }
            
        else if(intval($_POST['prixModifImm'])<0){
            $message="Le prix doit etre un entier positif!";
            $erreur++;
        }
        if($_POST['quantiteModif']==""){
            $erreur++;
            $message="Vous n'avez pas inséré de quantité";
        }
        else if(!is_numeric($_POST['quantiteModif'])){
            $erreur++;
            $message="La quantité doit etre un entier!";
        }
            
        else if(intval($_POST['quantiteModif'])<0){
            $erreur++;
            $message="La quantité doit etre un entier positif!";
        }
            
            
    }
    else if($_POST['typeModif']=="meilleure"){//si achat par meilleure offre
        if($_POST['dateFin']==""){
            $erreur++;
            $message="Vous n'avez pas la date de fin de l'enchère";
        }
        if($_POST['dateDebut']==""){
            $erreur++;
            $message="Vous n'avez pas la date de début de l'enchère";
        }

    }
    else if($_POST['typeModif']=="nego"){//si achat par negociation
    

    }
    else{
        $erreur++;
        $message="Le type d'achat n'est pas valide";
    }
  
   
    
    if($erreur==0){
            //concernant la photo principale / source = https://www.w3schools.com/PHP/php_file_upload.asp
        $enregistrer = "images_articles/" .basename($_FILES["photoPrincipaleModif"]["name"]);
        $target_dir = "../../../images_articles/";
        $target_file = $target_dir . basename($_FILES["photoPrincipaleModif"]["name"]);
        $uploadOk = 1;
        $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
        // Check if image file is a actual image or fake image
        if($_FILES["photoPrincipaleModif"]["tmp_name"]==''){
            $erreur++;
            $message="Problème sur le chargement de l'image principale";
        }
        if($erreur==0){
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
        }
        


        $nomPourEnregistreAutresPhotos=array();
      
        //Pour les autres photos
        if($erreur==0){
            for($i=0; $i<sizeof($_FILES['autrePhotos']['name']); $i++){
                if($_FILES['autrePhotos']["name"][$i]!=''){
                    gestionsPhotos("autrePhotos",$i,$erreur,$message);
                    $nomPourEnregistreAutresPhotos[$i] = "images_articles/" .basename($_FILES['autrePhotos']["name"][$i]);
                }
                
            }
        }
        
   
    }
    
    
  

    if($erreur==0){
        
        //Ajout dans a table article
        requeteSqlArray("INSERT INTO article (nom,description,nombreVendu,categorie,photoPrincipale,vendeurId) values ('{$_POST['nomModif']}','{$_POST['descriptionModif']}',0,'{$_POST['categorieModif']}','{$enregistrer}','{$_SESSION['idVendeur']}');",$pdo);
        $idArticle=requeteSqlArray("SELECT LAST_INSERT_ID();",$pdo);
      
      
        if($_POST['typeModif']=="achatImm"){ //Si achat immédiat
            requeteSqlArray("INSERT INTO articleimmediat (prixActuel,idArticle,quantite) values ('{$_POST['prixModifImm']}','{$idArticle[0]['LAST_INSERT_ID()']}','{$_POST['quantiteModif']}');",$pdo);
            $idArticleImm=requeteSqlArray("SELECT LAST_INSERT_ID();",$pdo);

            //Ajout idArticleImmediat dans article
            requeteSqlArray("UPDATE article set idArticleImmediat= '{$idArticleImm[0]['LAST_INSERT_ID()']}' where idArticle = '{$idArticle[0]['LAST_INSERT_ID()']}'",$pdo);
        }
        else if($_POST['typeModif']=="meilleure"){
            requeteSqlArray("INSERT INTO articleenchere (dateDebut,idArticle,dateFin) values ('{$_POST['dateDebut']}','{$idArticle[0]['LAST_INSERT_ID()']}','{$_POST['dateFin']}');",$pdo);
            $idArticleEnch=requeteSqlArray("SELECT LAST_INSERT_ID();",$pdo);

            //Ajout idArticleImmediat dans article
            requeteSqlArray("UPDATE article set idArticleEnchere= '{$idArticleEnch[0]['LAST_INSERT_ID()']}' where idArticle = '{$idArticle[0]['LAST_INSERT_ID()']}'",$pdo);
        }
        
        for($i=0; $i<sizeof($_FILES['autrePhotos']['name']); $i++){
            $ptEnregistrement=$nomPourEnregistreAutresPhotos[$i] ;
            //Ajout des images secondaires
            requeteSqlArray("INSERT INTO photo (lien,idLiaisonTable) values ('{$ptEnregistrement}','{$idArticle[0]['LAST_INSERT_ID()']}');",$pdo);
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