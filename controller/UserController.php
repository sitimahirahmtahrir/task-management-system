<?php
class UserController {
    public function getUsers($request, $response, $args) {
        require '../config/config.php';
        $stmt = $pdo->prepare("SELECT * FROM users");
        $stmt->execute();
        $users = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $response->withJson(['users' => $users]);
    }

    public function createUser($request, $response, $args) {
        require '../config/config.php';
        $data = $request->getParsedBody();
        $stmt = $pdo->prepare("INSERT INTO users (username, password, role) VALUES (?, MD5(?), ?)");
        $stmt->execute([$data['username'], $data['password'], $data['role']]);
        return $response->withJson(['success' => true]);
    }
}
?>
