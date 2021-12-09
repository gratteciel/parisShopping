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
        requeteSqlArray("INSERT INTO adresse (numeroVoie, rue, ville,codePostal,nom,pays,utilisateurId) VALUES ('{$_POST["numeroVoie"]}', '{$_POST["rue"]}', '{$_POST["ville"]}','{$_POST["codePostal"]}','{$_POST["nomAdresse"]}','{$_POST["pays"]}','{$_SESSION["idUtilisateur"]}');",$pdo);
    
    header('Location: ../index.php?page=votre_compte&alerts=1&tA=addAdresse&valA=rien');
    exit();
 ?>