<?php
// config.php
$host = 'localhost';
$db   = 'dmitra1';
$user = 'root';
$pass = '';
$charset = 'utf8mb4';

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "dmitra1";

$conn = new mysqli($servername, $username, $password, $dbname);


$dsn = "mysql:host=$host;dbname=$db;charset=$charset";
$options = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES   => false,
];

try {
    $pdo = new PDO($dsn, $user, $pass, $options);
} catch (\PDOException $e) {
    throw new \PDOException($e->getMessage(), (int)$e->getCode());
}