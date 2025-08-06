<?php
namespace src\app\Controllers;

class AuthController
{
    public function login($username, $password)
    {
        if ($username === 'admin' && $password === 'test') {
            $_SESSION['user'] = 'admin';
            return ['success' => true];
        }
        return ['success' => false, 'error' => 'Invalid credentials'];
    }

    public function checkAuth()
    {
        return isset($_SESSION['user']) && $_SESSION['user'] === 'admin';
    }

    public function logout()
    {
        session_destroy();
    }
}

?>
