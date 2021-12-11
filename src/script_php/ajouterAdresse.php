<?php  
    
    include('../bdd/donneeSession.php');
    include('../bdd/connectBDD.php');
    $erreur=0;

    if(!is_numeric($_POST["codePostal"])){
        $erreur++;
    
    }
     
    
    if(empty($_POST["codePostal"])  || empty($_POST["rue"]) || empty($_POST["ville"]) || empty($_POST["pays"]) || empty($_POST["nomAdresse"]) ){
        $erreur++;
       
    }
        

        

    if($erreur==0)
    {
        requeteSqlArray("INSERT INTO adresse (numeroVoie, rue, ville,codePostal,nom,pays,utilisateurId) VALUES ('{$_POST["numeroVoie"]}', '{$_POST["rue"]}', '{$_POST["ville"]}','{$_POST["codePostal"]}','{$_POST["nomAdresse"]}','{$_POST["pays"]}','{$_SESSION["idUtilisateur"]}');",$pdo);
        
        date_default_timezone_set('Europe/Paris');
        $date = date('Y-m-d H:i:s', time());

        //Création d'une notification
        requeteSqlArray("INSERT INTO notification (nom,descriptionNotif,dateNotif,idUtilisateur,vu,lien) values ('Ajout d\'adresse','Votre ajout d\'adresse ({$_POST["numeroVoie"]} {$_POST["rue"]} à {$_POST["ville"]}) a bien été pris en compte','{$date}','{$_SESSION['idUtilisateur']}',0,'votre_compte');",$pdo);
    }   
    $page=$_REQUEST['page'];
    if($page=="article")
        $page=$page.'&id='.$_REQUEST['id'];
   
    header('Location: ../index.php?page=' .$page  . '&alerts=1&tA=addAdresse&valA=rien');
    exit();
 ?>