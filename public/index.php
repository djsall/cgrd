<?php

use src\app\Controllers\AuthController;
use src\app\Models\News;

session_start();
require '../vendor/autoload.php';

$loader = new \Twig\Loader\FilesystemLoader('../src/views');
$twig = new \Twig\Environment($loader);

require '../src/config/config.php';
require '../src/app/controllers/AuthController.php';
require '../src/app/models/News.php';

$pdo = new PDO($dsn, $user, $pass);
$newsModel = new News($pdo);
$auth = new AuthController();
$action = $_GET['action'] ?? null;

if (!$auth->checkAuth() && $action !== 'login') {
    echo $twig->render('login.twig');
    exit;
}

switch ($action) {
    case 'login':
        $result = $auth->login($_POST['username'], $_POST['password']);
        if ($result['success']) {
            header("Location: /");
        } else {
            echo $twig->render('login.twig', ['error' => $result['error']]);
        }
        break;
    case 'save':
        if ($_POST['id']) {
            $newsModel->update($_POST['id'], $_POST['title'], $_POST['content']);
        } else {
            $newsModel->create($_POST['title'], $_POST['content']);
        }
        header("Location: /?message=Saved");
        break;
    case 'delete':
        $newsModel->delete($_GET['id']);
        header("Location: /?message=Deleted");
        break;
    default:
        $news = $newsModel->all();
        echo $twig->render('admin.twig', ['news' => $news, 'message' => $_GET['message'] ?? null]);
}
