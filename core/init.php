<?php
include 'database/connection.php';
include 'classes/user.php';
include 'classes/tweet.php';
include 'classes/follow.php';
include 'classes/message.php';

global $pdo;

session_start();

$getFromU = new User($pdo);
$getFromT = new Tweet($pdo);
$getFromF = new Follow($pdo);
$getFromM = new Message($pdo);

$server = $_SERVER['SERVER_NAME'];
$uri = explode('/', $_SERVER['REQUEST_URI'])[1];

// echo '<br>'.$uri.'<br>';

define("BASE_URL", "http://{$server}/{$uri}/");
// define("URI", $uri);
// echo BASE_URL;
?>