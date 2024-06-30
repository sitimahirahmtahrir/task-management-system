<?php
require '../config/config.php';
header('Content-Type: application/json');

$data = json_decode(file_get_contents('php://input'), true);
$email = $data['email'];

try {
    $pdo = new PDO("mysql:host=$db_host;dbname=$db_name", $db_user, $db_pass);
    // Insert the registration request into a registration_requests table
    $stmt = $pdo->prepare("INSERT INTO registration_requests (email) VALUES (?)");
    $stmt->execute([$email]);

    // Notify the admin about the new registration request
    // Note: You need to configure the mail function according to your server settings
    $admin_email = "admin@example.com"; // Replace with actual admin email
    mail($admin_email, "New User Registration Request", "There is a new registration request from: $email");

    echo json_encode(['success' => true]);
} catch (PDOException $e) {
    echo json_encode(['success' => false, 'error' => $e->getMessage()]);
}

