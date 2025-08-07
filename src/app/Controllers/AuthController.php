<?php
namespace src\app\Controllers;

class AuthController
{
    public function login($username, $password): array
    {
        if ($username === 'admin' && $password === 'test') {
            $_SESSION['user'] = 'admin';
            return ['success' => true];
        }
        return ['success' => false, 'error' => 'Wrong Login Data!'];
    }

    public function checkAuth(): bool
    {
        return isset($_SESSION['user']) && $_SESSION['user'] === 'admin';
    }

    public function logout(): void
    {
        session_destroy();
    }
}

?>
