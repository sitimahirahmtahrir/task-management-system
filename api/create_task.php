<?php
require '../config/config.php';
header('Content-Type: application/json');

$data = json_decode(file_get_contents('php://input'), true);
$title = $data['title'];
$description = $data['description'];
$due_date = $data['due_date'];
$status = $data['status'];
$assigned_to = $data['assigned_to'];

try {
    $pdo = new PDO("mysql:host=$db_host;dbname=$db_name", $db_user, $db_pass);
    $stmt = $pdo->prepare("INSERT INTO tasks (title, description, due_date, status, assigned_to) VALUES (?, ?, ?, ?, ?)");
    $stmt->execute([$title, $description, $due_date, $status, $assigned_to]);
    echo json_encode(['success' => true]);
} catch (PDOException $e) {
    echo json_encode(['success' => false, 'error' => $e->getMessage()]);
}
