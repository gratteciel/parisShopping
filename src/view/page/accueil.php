
<div class="Presentation_site p-3 pb-md-4 mx-auto text-center">
    <h1 style="color: white" class="display-4 fw-normal">Présentation du site</h1>
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


    <?php include count($productList) ? 'view/product/list.php' : 'view/product/noProducts.php'; ?>

</div>

<!-- Partie Google Map -->
<!--Google map-->
<!--Google map-->
<iframe id="map" style="border: 0;" src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d1312.6667734652472!2d2.2854332!3d48.8518497!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x47e6701b4f58251b%3A0x167f5a60fb94aa76!2sECE%20Paris%20Lyon!5e0!3m2!1sfr!2sfr!4v1638789588604!5m2!1sfr!2sfr" frameborder="0"></iframe>

