<?php
// Database connection parameters
$host = 'localhost';
$username = 'root';
$password = '';
$database = 'voucher_db';

$db_connection = mysqli_connect($host, $username, $password, $database);

$dsn = "mysql:host=$host;dbname=$database;";

$options = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES   => false,
];


try {
    $pdo = new PDO($dsn, $username, $password, $options);
} catch (\PDOException $e) {
    throw new \PDOException($e->getMessage(), (int)$e->getCode());
}
?>
