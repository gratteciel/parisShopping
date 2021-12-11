<?php
include_once __DIR__ . '/../bdd/donneeSession.php';
include_once __DIR__ . '/../../config/config.php';
include_once __DIR__ . '/../bdd/connectBDD.php';
include_once __DIR__ . '/../include/Admin.php';


try {
    Admin::ajoutVendeur($pdo, $_POST);
}
catch (\Exception $e) {
    echo sprintf("There was an error: <span style='font-weight: bold;color: red'>%s</span></br>", $e->getMessage());
    header('Location: ../index.php?page=' .$_REQUEST['page']  . '&alerts=1&tA=problemeVendeur&valA=rien');

    exit();
}

// success
header('Location: ../index.php?page=' .$_REQUEST['page']  . '&alerts=1&tA=addVendeur&valA=rien');
exit();