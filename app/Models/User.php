<?php
declare(strict_types=1);

namespace App\Models;

use App\Core\Database;
use PDOException;

class User
{
    public function create(string $username, string $email, string $password): bool
    {
        try {
            $statement = Database::connection()->prepare(
                'INSERT INTO users (username, email, password_hash) VALUES (:username, :email, :password_hash)'
            );

            return $statement->execute([
                'username' => trim($username),
                'email' => trim($email),
                'password_hash' => password_hash($password, PASSWORD_DEFAULT),
            ]);
        } catch (PDOException) {
            return false;
        }
    }

    public function findByEmail(string $email): ?array
    {
        try {
            $statement = Database::connection()->prepare('SELECT * FROM users WHERE email = :email LIMIT 1');
            $statement->execute(['email' => trim($email)]);
            $user = $statement->fetch();

            return $user ?: null;
        } catch (PDOException) {
            return null;
        }
    }

    public function existsByUsername(string $username): bool
    {
        try {
            $statement = Database::connection()->prepare('SELECT id FROM users WHERE username = :username LIMIT 1');
            $statement->execute(['username' => trim($username)]);

            return (bool) $statement->fetch();
        } catch (PDOException) {
            return false;
        }
    }

    public function existsByEmail(string $email): bool
    {
        try {
            $statement = Database::connection()->prepare('SELECT id FROM users WHERE email = :email LIMIT 1');
            $statement->execute(['email' => trim($email)]);

            return (bool) $statement->fetch();
        } catch (PDOException) {
            return false;
        }
    }
}
