<?php
include ".htpass";

$dbhost = DB_HOST;
$dbname = DB_NAME;
$dsn = "mysql:host=${dbhost};dbname=${dbname}";
$user = DB_USER;
$pass = DB_PASS;

try {
    $pdo = new PDO($dsn, $user, $pass);
} catch (PDOException $e) {
    echo 'Connection error! ' . $e->getMessage();
}
