<?php
include '../init.php';

if(isset($_POST['deleteComment']) && !empty($_POST['deleteComment'])){
    $user_id = $_SESSION['user_id'];
    $comment_id = $_POST['deleteComment'];
    $getFromU->delete('comments', array('commentID' => $comment_id, 'commentBy' => $user_id));
}
?>