<?php  
    
    include('../bdd/donneeSession.php');
    include('../bdd/connectBDD.php');
    $erreur=0;
    
    var_dump($_POST);

    if(!is_numeric($_POST["numero"])){
        $erreur++;
    
    }

    if(!is_numeric($_POST["codeSecu"])){
        $erreur++;
    
    }

    if(strlen($_POST["numero"])!=16)
        $erreur++;
    
    if(strlen($_POST["codeSecu"])!=3)
        $erreur++;
     
    
    if(empty($_POST["nomCarte"])  || empty($_POST["numero"]) || empty($_POST["typeCarte"]) || empty($_POST["codeSecu"]) ){
        $erreur++;
       
    }
        

        

    if($erreur==0)
        requeteSqlArray("INSERT INTO paiement (typeCarte, numeroCarte, nomCarte,dateExpiration,codeSecurite,utilisateurId) VALUES ('{$_POST["typeCarte"]}', '{$_POST["numero"]}', '{$_POST["nomCarte"]}','{$_POST["date"]}','{$_POST["codeSecu"]}','{$_SESSION["idUtilisateur"]}');",$pdo);
    
    header('Location: ../index.php?page=' .$_REQUEST['page']  . '&alerts=1&tA=addPaiement&valA=rien');
    exit();
 ?>