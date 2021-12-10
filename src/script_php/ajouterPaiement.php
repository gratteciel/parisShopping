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
        

        

    if($erreur==0){
        requeteSqlArray("INSERT INTO paiement (typeCarte, numeroCarte, nomCarte,dateExpiration,codeSecurite,utilisateurId) VALUES ('{$_POST["typeCarte"]}', '{$_POST["numero"]}', '{$_POST["nomCarte"]}','{$_POST["date"]}','{$_POST["codeSecu"]}','{$_SESSION["idUtilisateur"]}');",$pdo);
        date_default_timezone_set('Europe/Paris');
        $date = date('Y-m-d H:i:s', time());

        $carteSansDebut  = substr($_POST['numero'], -4);
        //Création d'une notification
        requeteSqlArray("INSERT INTO notification (nom,descriptionNotif,dateNotif,idUtilisateur,vu,lien) values ('Ajout d'un moyen de paiement','Votre ajout de paiement ({$_POST["typeCarte"]} terminant par {$carteSansDebut}) a bien été pris en compte','{$date}','{$_SESSION['idUtilisateur']}',0,'votre_compte');",$pdo);
    }
       
    
    header('Location: ../index.php?page=' .$_REQUEST['page']  . '&alerts=1&tA=addPaiement&valA=rien');
    exit();
 ?>