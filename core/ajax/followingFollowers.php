<?php
include '../init.php';

if(isset($_POST['unfollow']) && !empty($_POST['unfollow'])){
    $user_id = $_SESSION['user_id'];
    $follow_id = $_POST['unfollow'];
    $result['following'] = 1;

    echo json_encode($result);
}

if(isset($_POST['follow']) && !empty($_POST['follow'])){
    $user_id = $_SESSION['user_id'];
    $follow_id = $_POST['follow'];
    $result['following'] = 0;
    
    echo json_encode($result);
}
