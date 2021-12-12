<?php
// database connexion data
const MY_PDO_HOSTNAME = 'localhost';
const MY_PDO_PORT     = 3306;
const MY_PDO_DATABASE = 'parisShopping';
const MY_PDO_USERNAME = 'root';
const MY_PDO_PASSWORD = '';

// main folder/directory of our project
const PROJECT_ROOT_DIR = __DIR__ . '/..';

$configPageList = [
    'accueil'            => [
        'title'       => 'Accueil',
        'description' => '...',
    ],
    'article' => [
        'title'       => 'Article',
        'description' => '...',
    ],
    'commande' => [
        'title'       => 'Commande - Information',
        'description' => '...',
    ],
    'cahier_des_charges' => [
        'title'       => 'Cahier des charges',
        'description' => '...',
    ],
    'equipe'             => [
        'title'       => 'Equipe The Best',
        'description' => '...',
    ],
    'mentions'           => [
        'title'       => 'Mentions',
        'description' => '...',
    ],
    'votre_compte'       => [
        'title'       => 'Votre compte',
        'description' => '...',
    ],
    'site'               => [
        'title'       => 'Site',
        'description' => '...',
    ],
    'panier/panier' => [
        'title' => 'Mon Panier',
        'description' => '...',
    ],
    'toutParcourir' => [
        'title' => 'Mon Panier',
        'description' => '...',
    ],
    'notifications' => [
        'title' => 'Mon Panier',
        'description' => '...',
    ],
    'vendeur' => [
        'title' => 'Pannel Vendeur',
        'description' => '...',
    ],
    'admin' => [
        'title' => 'Pannel admininstrateur',
        'description' => '...',
    ],
    'notfound'           => [
        'title'       => '....Main Title...',
        'description' => '...',
    ],

];