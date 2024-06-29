<?php
class TaskController {
    public function getTasks($request, $response, $args) {
        require '../config/config.php';
        $stmt = $pdo->prepare("SELECT * FROM tasks");
        $stmt->execute();
        $tasks = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $response->withJson(['tasks' => $tasks]);
    }

    public function createTask($request, $response, $args) {
        require '../config/config.php';
        $data = $request->getParsedBody();
        $stmt = $pdo->prepare("INSERT INTO tasks (title, description, status, assigned_to) VALUES (?, ?, ?, ?)");
        $stmt->execute([$data['title'], $data['description'], $data['status'], $data['assigned_to']]);
        return $response->withJson(['success' => true]);
    }
}
?>
