<?php
require 'vendor/autoload.php';

$app = new \Slim\App;

require 'src/TaskController.php';
require 'src/UserController.php';

$app->post('/api/login.php', function ($request, $response, $args) {
    include 'src/login.php';
});

$app->run();
?>
