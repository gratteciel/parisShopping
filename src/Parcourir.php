<html>
<head>

    <link href="../assets/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="canonical" href="https://getbootstrap.com/docs/5.1/examples/pricing/">
    <link rel="stylesheet" type="text/css" href="css/Parcourir.css">
    <title>Tout Parcourir</title>

</head>
<body>
<header>
</header>

</body>

<?php



$database = "books";
$productList = Database::getProductListFromDatabase();

$db_handle = mysqli_connect('localhost', 'root', '');
$db_found = mysqli_select_db($db_handle, $database);

if (isset($_POST["button1"])) {
    if ($db_found) {
        $sql = "SELECT * FROM ";
}


}

?>





</html>
