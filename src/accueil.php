<html>
<head>
    <!-- Include du CSS Bootstrap -->
    <link href="../assets/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="canonical" href="https://getbootstrap.com/docs/5.1/examples/pricing/">
    <link rel="stylesheet" type="text/css" href="css/main.css">
    <title>Acceuil</title>
</head>
<body>
<?php include("header.php"); ?>
<script src="../assets/dist/js/bootstrap.bundle.min.js"></script>


<div class="Presentation_site p-3 pb-md-4 mx-auto text-center">
    <h1 class="display-4 fw-normal">Présentation du site</h1>
    <p class="fs-5 text-muted">Voici une petite description de notre site d'eshopping sur paris </p>
    <!-- Mettre une photo du shopping -->
</div>
<?php
// read this from database
// now we use hardcoded ...
// $productList = Database::getProductListFromDatabase();
$productList = [
    (object) [
        'id'      => 1,
        'name'    => 'Product Name 1',
        'price'   => 12.35,
        'img_url' => 'https://images.unsplash.com/photo-1505740420928-5e560c06d30e?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxzZWFyY2h8M3x8cHJvZHVjdHxlbnwwfHwwfHw%3D&w=1000&q=80',
    ],
    (object) [
        'id'      => 2,
        'name'    => 'MacBook Pro',
        'price'   => 27.15,
        'img_url' => 'https://images.unsplash.com/photo-1505740420928-5e560c06d30e?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxzZWFyY2h8M3x8cHJvZHVjdHxlbnwwfHwwfHw%3D&w=1000&q=80',
    ],
    (object) [
        'id'      => 3,
        'name'    => 'Headset JB',
        'price'   => 8.25,
        'img_url' => 'https://images.unsplash.com/photo-1505740420928-5e560c06d30e?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxzZWFyY2h8M3x8cHJvZHVjdHxlbnwwfHwwfHw%3D&w=1000&q=80',
    ],
    (object) [
        'id'      => 4,
        'name'    => 'Headset JB2',
        'price'   => 8.25,
        'img_url' => 'https://images.unsplash.com/photo-1505740420928-5e560c06d30e?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxzZWFyY2h8M3x8cHJvZHVjdHxlbnwwfHwwfHw%3D&w=1000&q=80',
    ],
    (object) [
        'id'      => 5,
        'name'    => 'Headset JB3',
        'price'   => 8.25,
        'img_url' => 'https://images.unsplash.com/photo-1505740420928-5e560c06d30e?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxzZWFyY2h8M3x8cHJvZHVjdHxlbnwwfHwwfHw%3D&w=1000&q=80',
    ],
];
?>

<div class="Presentation_site p-3 pb-md-4 mx-auto text-center">

    <h2 id="ventesFlash">Ventes Flash</h2>
<?php include count($productList) ? 'view/product/list.php' : 'view/product/noProducts.php';  ?>

</div>


<!-- Partie Google Map -->
<div id="map-container-google-1" class="z-depth-1-half map-container" style="height: 500px">
    <iframe src="https://maps.google.com/maps?q=manhatan&t=&z=13&ie=UTF8&iwloc=&output=embed" frameborder="0"
            style="border:0" allowfullscreen></iframe>
</div>
</body>
</html>