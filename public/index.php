<?php
// Autoload or require config and controller
$config = require_once __DIR__ . '/../config/database.php';
require_once __DIR__ . '/../src/controllers/QuestionController.php';

// Database connection
try {
    $dsn = "mysql:host={$config['host']};dbname={$config['dbname']};charset={$config['charset']}";
    $db = new PDO($dsn, $config['username'], $config['password']);
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die('Database connection failed: ' . $e->getMessage());
}

// Handle USSD request
$controller = new QuestionController($db);
$controller->handleUSSDRequest();

// Remove the test code
file_put_contents('test.log', "POST: " . json_encode($_POST) . PHP_EOL, FILE_APPEND);
file_put_contents('test.log', "GET: " . json_encode($_GET) . PHP_EOL, FILE_APPEND);
file_put_contents('test.log', "RAW: " . file_get_contents('php://input') . PHP_EOL, FILE_APPEND);
echo "END Test successful";

echo "END Hello from USSD!"; 