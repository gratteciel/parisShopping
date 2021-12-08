<?php
// Création du DSN
$dsn = 'mysql:host=localhost;dbname=parisShopping;port=3306;charset=utf8';
$dsn = sprintf(
    'mysql:host=%s;dbname=%s;port=%d;charset=utf8',
    MY_PDO_HOSTNAME,
    MY_PDO_DATABASE,
    MY_PDO_PORT
);

// Création et test de la connexion
try {
    $pdo = new PDO($dsn, MY_PDO_USERNAME, MY_PDO_PASSWORD);
} catch (PDOException $exception) {
    exit('Erreur de connexion à la base de données');
}
$test = "port";

function requeteSqlArray($requeteString, $pdo)
{
    // Requête pour tester la connexion

    $query = $pdo->query($requeteString);


    return $query->fetchAll();
}
