<?php
    
    $notificationListNew = requeteSqlArray("SELECT * from notification where idUtilisateur = '{$_SESSION['idUtilisateur']}' and  vu = 0 ORDER BY dateNotif DESC",$pdo);
    $notificationListAnciennes = requeteSqlArray("SELECT * from notification where idUtilisateur = '{$_SESSION['idUtilisateur']}' and  vu != 0 ORDER BY dateNotif DESC",$pdo);

//include count($notificationList) ? 'view/notification/list.php' : '../product/noProducts.php';
?>  
    <h1 style="margin:20px;margin-bottom:50px;;text-align:center">Notifications</h1>

    <?php if (sizeof($notificationListNew)==0): ?>
        <h3 style="margin-left:10px;">Aucune Nouvelle notification</h3>
    <?php else: ?>
        <h3 style="margin-left:10px;">Nouvelles notifications</h3>
    <?php endif; ?>

    <div class="notification">
    
    
        <?php foreach ($notificationListNew as $notificationInfo): ?>
            
                <a href="index.php?page=<?php echo $notificationInfo['lien']; ?>" class="list-group-item list-group-item-warning"      style="margin-bottom:10px;">
                    <div class="d-flex w-100 justify-content-between">
                        <h5 class="mb-1"><?php echo $notificationInfo['nom']; ?></h5>
                        <small><?php echo $notificationInfo['dateNotif']; ?></small>
                    </div>
                    <p class="mb-1"><?php echo $notificationInfo['descriptionNotif']; ?></p>

                </a>
            
        <?php endforeach; ?>

    </div>
    
    <hr style="margin-bottom:40px;margin-top:40px;">

    <div style="width:70%;margin:auto;" class="border">
    
        <?php if (sizeof($notificationListAnciennes)==0): ?>
            <h3 style="margin-left:10px;">Aucune ancienne notification</h3>
        <?php else: ?>
            <div style="display:flex;flex-direction:row;margin-bottom:30px;margin:10px;">
                <button id="afficherPaie" type="button" style="color:white" class="btn btn-outline-secondary " onclick="afficherOuPas('notifAncienne')">Afficher</button></h1>
                <h3 style="margin-left:10px;">les anciennes notifications</h3>
            </div> 
        <?php endif; ?>
              
        
        <div class="notification" id="notifAncienne" style="display:none;margin:10px;">
            <?php foreach ($notificationListAnciennes as $notificationInfo): ?>
                
                    <a href="index.php?page=<?php echo $notificationInfo['lien']; ?>" class="list-group-item"  style="margin-bottom:10px;">
                        <div class="d-flex w-100 justify-content-between">
                            <h5 class="mb-1"><?php echo $notificationInfo['nom']; ?></h5>
                            <small><?php echo $notificationInfo['dateNotif']; ?></small>
                        </div>
                        <p class="mb-1"><?php echo $notificationInfo['descriptionNotif']; ?></p>

                    </a>
                
            <?php endforeach; ?>
        </div>
    </div>
<?php
    
   requeteSqlArray("UPDATE notification set vu = 1 where idUtilisateur = '{$_SESSION['idUtilisateur']}'",$pdo);

//include count($notificationList) ? 'view/notification/list.php' : '../product/noProducts.php';
?>