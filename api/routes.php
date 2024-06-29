<?php
require 'vendor/autoload.php';

$app = new \Slim\App;

require 'controllers/TaskController.php';
require 'controllers/UserController.php';

$app->post('/api/login', function ($request, $response, $args) {
    include 'api/login.php';
});

$app->get('/api/tasks', 'TaskController:getTasks');
$app->post('/api/tasks', 'TaskController:createTask');
$app->get('/api/users', 'UserController:getUsers');
$app->post('/api/users', 'UserController:createUser');

$app->run();
?>
