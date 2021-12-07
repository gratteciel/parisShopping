
<?php
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

<div class="Magasin p-3 pb-md-4 mx-auto text-center">
    <h1 style="color: white" class="display-4 fw-normal">Types d'articles</h1>
    <p class="fs-5 text-muted">Retrouvez ici tous les articles triés par catégories </p>
    <ul>
    </ul>
</div>






    <div class="Presentation_site p-3 pb-md-4 mx-auto text-center">

        <?php include count($productList) ? 'view/product/list.php' : '../product/noProducts.php'; ?>

    </div>




















