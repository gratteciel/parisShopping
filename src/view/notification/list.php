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