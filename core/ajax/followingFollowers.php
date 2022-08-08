<?php
include '../init.php';

if(isset($_POST['unfollow']) && !empty($_POST['unfollow'])){
    $user_id = $_SESSION['user_id'];
    $follow_id = $_POST['unfollow'];
    $profile_id = $_POST['profile'];
    $getFromF->unfollow($follow_id, $user_id, $profile_id);
}

if(isset($_POST['follow']) && !empty($_POST['follow'])){
    $user_id = $_SESSION['user_id'];
    $follow_id = $_POST['follow'];
    $profile_id = $_POST['profile'];
    $getFromF->follow($follow_id, $user_id, $profile_id);
}
