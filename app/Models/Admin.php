<?php
declare(strict_types=1);

namespace App\Models;

use App\Core\Database;
use PDOException;

class Admin
{
    public function create(string $name, string $email, string $password): bool
    {
        $statement = Database::connection()->prepare(
            'INSERT INTO admins (name, email, password_hash) VALUES (:name, :email, :password_hash)'
        );

        return $statement->execute([
            'name' => trim($name),
            'email' => trim($email),
            'password_hash' => password_hash($password, PASSWORD_DEFAULT),
        ]);
    }

    public function findByEmail(string $email): ?array
    {
        try {
            $statement = Database::connection()->prepare('SELECT * FROM admins WHERE email = :email LIMIT 1');
            $statement->execute(['email' => $email]);
            $admin = $statement->fetch();

            return $admin ?: null;
        } catch (PDOException) {
            return null;
        }
    }
}
