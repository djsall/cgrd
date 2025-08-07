<?php

declare(strict_types=1);

use src\app\Controllers\AuthController;
use src\app\Controllers\NewsController;
use src\app\Models\News;

session_start();

require '../vendor/autoload.php';
require '../src/config/config.php';

$twig = new \Twig\Environment(
    new \Twig\Loader\FilesystemLoader('../src/views')
);

$pdo = new PDO($dsn, $user, $pass, [
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
]);

$auth = new AuthController($twig);
$newsModel = new News($pdo);
$newsController = new NewsController($newsModel, $twig);

$action = $_GET['action'] ?? null;

$auth = new AuthController($twig);

if (!$auth->isAuthenticated() && $action !== 'login') {
    $auth->showLoginForm();
}

switch ($action) {
    case 'login':
        $auth->login($_POST['username'] ?? '', $_POST['password'] ?? '');
        break;

    case 'logout':
        $auth->logout();
        break;

    case 'save':
        $newsController->save($_POST);
        break;

    case 'delete':
        $newsController->delete($_GET['id'] ?? null);
        break;

    default:
        $newsController->index($_GET['message'] ?? null);
        break;
}
