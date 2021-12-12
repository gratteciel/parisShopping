<?php
include_once __DIR__ . '/../bdd/donneeSession.php';
include_once __DIR__ . '/../../config/config.php';
include_once __DIR__ . '/../bdd/connectBDD.php';
include_once __DIR__ . '/../include/Admin.php';

/**
 * if (!administrator) {
 *  header...
 * }
 */
try {
    $foundEntries = Admin::rechercherVendeur($pdo, $_POST);
}
catch (\Exception $e) {
    echo sprintf("There was an error: <span style='font-weight: bold;color: red'>%s</span></br>", $e->getMessage());
    header('Location: ../index.php?page=' .$_REQUEST['page']  . '&alerts=1&tA=problemeRechercheVendeur&valA=rien');

    exit();
}

// register in the session the result. and we will unset it in the redirected page
$_SESSION['rechercherVendeurResults'] = $foundEntries;
// success
header('Location: ../index.php?page=' .$_REQUEST['page']  . '&alerts=1&tA=supprVendeur&valA=rien');
exit();
