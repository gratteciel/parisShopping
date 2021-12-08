<?php
$notificationList = [
(object) [
'id'      => 1,
'name'    => 'Inscription',
'time'   => 12,
'des' => 'Merci pour vous être inscrit',
],
(object) [
'id'      => 2,
'name'    => 'Verification de mail',
'time'   => 11,
'des' => 'Votre mail a bien été verifié',
    ],
(object) [
'id'      => 3,
'name'    => 'Vente accepté',
'time'   => 8,
'des' => 'Merci pour la moula',
],
(object) [
'id'      => 4,
'name'    => 'Annulation de commande',
'time'   => 6,
'des' => 'Votre commande a été annulé',
],
(object) [
'id'      => 5,
'name'    => 'Carte graphique',
'time'   => 3,
'des' => 'Jean-Louis a accepté le prix que vous avez négocié',
],
];

//include count($notificationList) ? 'view/notification/list.php' : '../product/noProducts.php';
?>

<div class="notification">
<?php foreach ($notificationList as $notificationInfo): ?>
        <a href="#" class="list-group-item list-group-item-action">
            <div class="d-flex w-100 justify-content-between">
                <h5 class="mb-1"><?php echo $notificationInfo->name; ?></h5>
                <small> il y a <?php echo $notificationInfo->time; ?> jour</small>
            </div>
            <p class="mb-1"><?php echo $notificationInfo->des; ?></p>
            <small>And some small print.</small>
            </a>

<?php endforeach; ?>
</div>
