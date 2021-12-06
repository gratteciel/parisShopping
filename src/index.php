<?php
include '../config/config.php';

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
?><!doctype html>
<html>
<head>
    <title><?php echo $configPageList[$page]['title'];?></title>

    <link rel="canonical" href="https://getbootstrap.com/docs/5.1/examples/cover/">
    <link rel="stylesheet" type="text/css" href="css/main.css?<?php echo time(); ?>">
    <!-- Bootstrap core CSS -->
    <link href="../assets/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="text-white bg-dark">

<div class="cover-container w-100 h-100 mx-auto">
    <?php
    include("view/header.php");
    include('bdd/donneeSession.php');
    ?>
    <main id="body">
        <?php include("view/page/{$page}.php"); ?>
    </main>
</div>

<?php include("view/footer.php"); ?>

</body>
</html>
