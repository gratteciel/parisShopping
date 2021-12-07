<?php
    // Création du DSN
    $dsn = 'mysql:host=localhost;dbname=parisShopping;port=3306;charset=utf8';
   
     // Création et test de la connexion
    try {
        $pdo = new PDO($dsn, 'root' , '');
    }
    catch (PDOException $exception) {
        exit('Erreur de connexion à la base de données');
    }
    $test="port";


    function requeteSqlArray($requeteString,$pdo){
        // Requête pour tester la connexion
    
        $query = $pdo->query($requeteString);
    
    
        $resultat = $query->fetchAll();
    
        return $resultat;
    } 
?>
