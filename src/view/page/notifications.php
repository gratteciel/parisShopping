<?php

$notificationList =  requeteSqlArray("SELECT * from notification where idUtilisateur= '{$_SESSION['idUtilisateur']}'ORDER BY `date` DESC", $pdo)


//include count($notificationList) ? 'view/notification/list.php' : '../product/noProducts.php';
?>

<div>
<?php foreach ($notificationList as $notificationInfo): ?>
    <div class="list-group-item list-group-item-action>

        <a href="index.php?page=article&id=<?php echo $notificationInfo['idArticle']?>">
            <div class="d-flex w-100 justify-content-between">
                <h5 class="mb-1"><?php echo $notificationInfo['nom']; ?></h5>
                <small> <?php echo $notificationInfo['date']; ?> </small>
            </div>
            <p class="mb-1"><?php echo $notificationInfo['description']; ?></p>
        </a>
        <small><button onclick="location.href='script_php/Notification/suppNotification.php?idNotification=<?php echo $notificationInfo['idNotification'] ?>'" type="button" class="btn btn-danger">Supprimer la notification</button></small>
    </div>

<?php endforeach; ?>
</div>
