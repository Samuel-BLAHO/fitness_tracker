<?php
declare(strict_types=1);

namespace App\Controllers;

use App\Core\Auth;
use App\Models\Admin;

class AuthController
{
    public function login(array $data): ?string
    {
        $email = trim((string) ($data['email'] ?? ''));
        $password = (string) ($data['password'] ?? '');

        if ($email === '' || $password === '') {
            return 'Please enter both email and password.';
        }

        $admin = (new Admin())->findByEmail($email);

        if (!$admin || !password_verify($password, $admin['password_hash'])) {
            return 'Invalid admin login credentials.';
        }

        Auth::login((int) $admin['id'], $admin['name']);
        header('Location: admin/index.php');
        exit;
    }
}

