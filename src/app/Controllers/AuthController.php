<?php

namespace src\app\Controllers;

use Twig\Environment;

class AuthController
{
    private Environment $twig;

    public function __construct(Environment $twig)
    {
        $this->twig = $twig;
    }

    public function login(string $username, string $password): void
    {
        if ($this->isValidCredentials($username, $password)) {
            $_SESSION['user'] = $username;
            header('Location: /');
            exit;
        }

        echo $this->twig->render('login.twig', [
            'error' => 'Invalid username or password.'
        ]);
        exit;
    }

    public function logout(): void
    {
        session_unset();
        session_destroy();
        header('Location: /');
        exit;
    }

    public function isAuthenticated(): bool
    {
        return isset($_SESSION['user']);
    }

    private function isValidCredentials(string $username, string $password): bool
    {
        return $username === 'admin' && $password === 'test';
    }

    public function showLoginForm(): void
    {
        echo $this->twig->render('login.twig');
        exit;
    }
}
