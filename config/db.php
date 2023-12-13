<?php

require_once __DIR__ . '/../resources/vendor/autoload.php';

use Dotenv\Dotenv;

$dotenv = Dotenv::createImmutable(__DIR__ . '/../resources');
$dotenv->load();

$host = $_ENV['DB_HOST'];
$name = $_ENV['DB_name'];
$dsn = "mysql:host=$host;dbname=$name";
$user = $_ENV['DB_user'];
$pass = $_ENV['DB_pass'];

try {
    $pdo = new PDO($dsn, $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e) {
    echo "Connection Failed: " . $e->getMessage();
}