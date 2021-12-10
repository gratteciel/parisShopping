<?php
$filtre_value          = isset($_POST["filtre_value"])? $_POST["filtre_value"] :"";
$filtre_qualite        = isset($_POST["filtre_qualite"])? $_POST["filtre_qualite"] :"";





    header('Location: ../index.php?page=toutParcourir&filtre_value='.$filtre_value.'&filtre_qualite='.$filtre_qualite);
    exit();
?>