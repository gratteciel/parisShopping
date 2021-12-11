<?php 

    include('../../bdd/donneeSession.php');
    include('../../bdd/connectBDD.php');

    if(isset($_POST["submit"])) {
        $erreur=0;
        $message="";
        $enregistrer="";
        if($_FILES['photoVendeurAjout']['name']==''){
            $erreur++;
            $message="Veuillez insérer une image";
        }
        if($erreur==0){
            //concernant du vendeur / source = https://www.w3schools.com/PHP/php_file_upload.asp
         $enregistrer = "images_vendeur/" .basename($_FILES["photoVendeurAjout"]["name"]);
         $target_dir = "../../../images_vendeur/";
         $target_file = $target_dir . basename($_FILES["photoVendeurAjout"]["name"]);
         $uploadOk = 1;
         $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
         // Check if image file is a actual image or fake image
         if($_FILES["photoVendeurAjout"]["tmp_name"]==''){
             $erreur++;
             $message="Problème sur le chargement de l'image";
         }

         if($erreur==0){
             $check = getimagesize($_FILES["photoVendeurAjout"]["tmp_name"]);
             if($check !== false) {
                 $uploadOk = 1;
             } else {
                 $erreur++;
                 $uploadOk = 0;
                 $message="Aucune image n'a été upload :(";
             }
             if($uploadOk==1){
                 if (move_uploaded_file($_FILES["photoVendeurAjout"]["tmp_name"], $target_file)) {
                     echo "The file ". htmlspecialchars( basename( $_FILES["photoVendeurAjout"]["name"])). " has been uploaded.";
             } else {
                 $erreur++;
                 $message="Problème sur le chargement de l'image";
             }
             }
         }
        }

        if($erreur==0){
            requeteSqlArray("UPDATE vendeur set photoVendeur ='{$enregistrer}' where idVendeur = '{$_SESSION['idVendeur']}'",$pdo);
            header('Location: ../../index.php?page=vendeur');
            exit();
        }
        else{
            header('Location: ../../index.php?page=vendeur&err2=1&msg='.$message);
            exit();
        }
         


      

    }

?>