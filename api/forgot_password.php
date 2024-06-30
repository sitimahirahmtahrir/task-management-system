<?php
require '../config/config.php';
header('Content-Type: application/json');

$data = json_decode(file_get_contents('php://input'), true);
$email = $data['email'];

// Generate a default password
$default_password = 'defaultpassword123';

try {
    $pdo = new PDO("mysql:host=$db_host;dbname=$db_name", $db_user, $db_pass);
    $stmt = $pdo->prepare("UPDATE users SET password = MD5(?) WHERE email = ?");
    $stmt->execute([$default_password, $email]);

    // Send email to the user with the default password
    // Note: You need to configure the mail function according to your server settings
    mail($email, "Password Reset", "Your new password is: $default_password");

    echo json_encode(['success' => true]);
} catch (PDOException $e) {
    echo json_encode(['success' => false, 'error' => $e->getMessage()]);
}

