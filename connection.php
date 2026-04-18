<?php
// These match the 'environment' variables in your docker-compose.yml
$host = 'db'; // The service name in docker-compose.yml
$db   = 'my_database';
$user = 'root';
$pass = 'root_password';
$charset = 'utf8mb4';

$dsn = "mysql:host=$host;dbname=$db;charset=$charset";
$options = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES   => false,
];

try {
     $conn = new PDO($dsn, $user, $pass, $options);
} catch (\PDOException $e) {
     echo "<h1>❌ Connection Failed</h1>";
     echo "<p>Error: " . $e->getMessage() . "</p>";
     exit;
}