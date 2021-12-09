<?php

include_once __DIR__ . '/bdd/donneeSession.php';
include '../config/config.php';
include_once PROJECT_ROOT_DIR . '/src/bdd/connectBDD.php';

if (empty($_GET['page'])) {
    // default page
    $page = 'accueil';
}
else {
    $page = ($_GET['page']);
}
if (!array_key_exists($page, $configPageList)) {
    $page = "notfound";
}
?>
<!doctype html>
<html>
    <head>
        <title><?php echo $configPageList[$page]['title'];?></title>

        <link rel="canonical" href="https://getbootstrap.com/docs/5.1/examples/cover/">
        <link rel="stylesheet" type="text/css" href="css/main.css?<?php echo time(); ?>">
        <!-- Bootstrap core CSS -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
<!--        <link href="../assets/dist/css/bootstrap.min.css" rel="stylesheet">-->
    </head>
    <body class="text-white bg-dark">


        <div class="cover-container w-100 h-100 mx-auto">
            <?php
            //include('bdd/donneeSession.php');
            include("view/header.php");
            ?>
            <main id="body" class="container">
                <!-- Permet d'afficher les alerts -->
                <div id="afficheAlert"></div>



                <?php include("view/page/{$page}.php"); ?>
            </main>
        </div>

        <?php include("view/footer.php"); ?>
        <!-- Permet les interactions avec les alerts -->

        <script src="script_js/alert.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    </body>
</html>
