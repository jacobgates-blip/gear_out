<?php
// Database connection for Gear Out — PDO, not mysqli.
// Named to match the class template convention (conn_1dt.php),
// but built with PDO + prepared statements throughout the rest of the site.
$host = 'db';
$dbname = 'gearout';
$user = 'root';
$pass = getenv('DB_ROOT_PASSWORD');
$charset = 'utf8mb4';

$dsn = "mysql:host=$host;dbname=$dbname;charset=$charset";

$options = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES   => false,
];

try {
    $pdo = new PDO($dsn, $user, $pass, $options);
} catch (PDOException $e) {
    throw new PDOException($e->getMessage(), (int) $e->getCode());
}
