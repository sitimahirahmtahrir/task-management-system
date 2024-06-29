<?php
require '../config/config.php';
header('Content-Type: application/json');

try {
    $pdo = new PDO("mysql:host=$db_host;dbname=$db_name", $db_user, $db_pass);
    $stmt = $pdo->prepare("SELECT * FROM tasks");
    $stmt->execute();
    $tasks = $stmt->fetchAll(PDO::FETCH_ASSOC);

    echo json_encode(['tasks' => $tasks]);
} catch (PDOException $e) {
    echo json_encode(['error' => $e->getMessage()]);
}
?>
