<?php
    include '../core/init.php';
    $getFromU->logout();
    if(!$getFromU->loggedIn()) {
        header('Location: '.BASE_URL.'index.php');
    }
?>