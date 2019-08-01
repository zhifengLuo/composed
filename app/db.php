<?php

$envFile = __DIR__ . '/../.env';
if (is_file($envFile)) {
    $env = parse_ini_file($envFile);
} else {
    echo 'no config file!';
    exit;
}

$servername = "mysql";
$username = "root";
$password = $env['MYSQL_DB_PASSWORD'] ?? '123456';

try {
    $conn = new PDO("mysql:host=$servername;", $username, $password);
    echo "connect db success!";
} catch (PDOException $e) {
    echo $e->getMessage();
}