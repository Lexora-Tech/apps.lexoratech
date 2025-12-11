<?php
// db.php
$host = 'localhost';
$db = 'lexora_apps';
$user = 'root';
$pass = 'JapL050514';

$conn = new mysqli($host, $user, $pass, $db);

if ($conn->connect_error) {
    // Return a JSON error so the frontend knows it failed
    header('Content-Type: application/json');
    die(json_encode(["message" => "Database connection failed: " . $conn->connect_error]));
}
?>