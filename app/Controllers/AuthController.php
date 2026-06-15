<?php
declare(strict_types=1);

namespace App\Controllers;

use App\Core\Auth;
use App\Core\Csrf;
use App\Models\Admin;
use App\Models\User;

class AuthController
{
    public function login(array $data): ?string
    {
        $email = trim((string) ($data['email'] ?? ''));
        $password = (string) ($data['password'] ?? '');

        if (!Csrf::verify($data['csrf_token'] ?? null)) {
            return 'Invalid form token. Please try again.';
        }

        if ($email === '' || $password === '') {
            return 'Please enter both email and password.';
        }

        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            return 'Please enter a valid email address.';
        }

        $admin = (new Admin())->findByEmail($email);

        if ($admin && password_verify($password, $admin['password_hash'])) {
            Auth::login((int) $admin['id'], $admin['name']);
            header('Location: admin/index.php');
            exit;
        }

        $user = (new User())->findByEmail($email);

        if ($user && password_verify($password, $user['password_hash'])) {
            Auth::memberLogin((int) $user['id'], $user['username']);
            header('Location: index.php');
            exit;
        }

        return 'Invalid login credentials.';
    }

    public function register(array $data): array
    {
        $user = new User();
        $username = trim((string) ($data['username'] ?? ''));
        $email = trim((string) ($data['email'] ?? ''));
        $password = (string) ($data['password'] ?? '');
        $confirmPassword = (string) ($data['confirm_password'] ?? '');
        $errors = [];

        if (!Csrf::verify($data['csrf_token'] ?? null)) {
            $errors[] = 'Invalid form token. Please try again.';
        }

        if ($username === '') {
            $errors[] = 'Username is required.';
        }

        if ($email === '') {
            $errors[] = 'Email address is required.';
        } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $errors[] = 'Please enter a valid email address.';
        }

        if ($password === '') {
            $errors[] = 'Password is required.';
        } elseif (strlen($password) < 8) {
            $errors[] = 'Password must be at least 8 characters long.';
        }

        if ($confirmPassword === '') {
            $errors[] = 'Please confirm your password.';
        } elseif ($password !== $confirmPassword) {
            $errors[] = 'Password and confirm password must match.';
        }

        if ($username !== '' && $user->existsByUsername($username)) {
            $errors[] = 'That username is already taken.';
        }

        if ($email !== '' && filter_var($email, FILTER_VALIDATE_EMAIL) && $user->existsByEmail($email)) {
            $errors[] = 'That email address is already registered.';
        }

        if ($errors !== []) {
            return $errors;
        }

        if (!$user->create($username, $email, $password)) {
            return ['We could not create your account. Please try again.'];
        }

        return [];
    }
}
