<?php
    include('../../bdd/donneeSession.php');
    include('../../bdd/connectBDD.php');
    requeteSqlArray("DELETE FROM `notification` where idNotification='{$_REQUEST["idNotification"]}'",$pdo);
    header('Location: ../../index.php?page=notifications');
    exit();