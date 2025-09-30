<?php
// db.php - database connection
$host = "localhost";
$port = "5432";
$dbname = "portfolio";
$db_user = "Sol";
$db_pass = "dkstbsu";

try {
    $dsn = "pgsql:host=$host;port=$port;dbname=$dbname;";
    $pdo = new PDO($dsn, $db_user, $db_pass, [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
    ]);
} catch (PDOException $e) {
    die("Database Connection Failed: " . $e->getMessage());
}
