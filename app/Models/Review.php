<?php
declare(strict_types=1);

namespace App\Models;

use App\Core\Database;
use PDOException;

class Review
{
    public function all(): array
    {
        try {
            $statement = Database::connection()->query(
                'SELECT reviews.*, users.username
                 FROM reviews
                 INNER JOIN users ON users.id = reviews.user_id
                 ORDER BY reviews.created_at DESC, reviews.id DESC'
            );

            return $statement->fetchAll();
        } catch (PDOException) {
            return [];
        }
    }

    public function find(int $id): ?array
    {
        try {
            $statement = Database::connection()->prepare(
                'SELECT reviews.*, users.username
                 FROM reviews
                 INNER JOIN users ON users.id = reviews.user_id
                 WHERE reviews.id = :id
                 LIMIT 1'
            );
            $statement->execute(['id' => $id]);
            $review = $statement->fetch();

            return $review ?: null;
        } catch (PDOException) {
            return null;
        }
    }

    public function create(int $userId, array $data): bool
    {
        try {
            $statement = Database::connection()->prepare(
                'INSERT INTO reviews (user_id, rating, title, review_text)
                 VALUES (:user_id, :rating, :title, :review_text)'
            );

            return $statement->execute($this->cleanData($data, $userId));
        } catch (PDOException) {
            return false;
        }
    }

    public function update(int $id, array $data): bool
    {
        try {
            $values = $this->cleanData($data);
            $values['id'] = $id;

            $statement = Database::connection()->prepare(
                'UPDATE reviews
                 SET rating = :rating, title = :title, review_text = :review_text
                 WHERE id = :id'
            );

            return $statement->execute($values);
        } catch (PDOException) {
            return false;
        }
    }

    public function delete(int $id): bool
    {
        try {
            $statement = Database::connection()->prepare('DELETE FROM reviews WHERE id = :id');

            return $statement->execute(['id' => $id]);
        } catch (PDOException) {
            return false;
        }
    }

    private function cleanData(array $data, ?int $userId = null): array
    {
        $values = [
            'rating' => (int) ($data['rating'] ?? 0),
            'title' => trim((string) ($data['title'] ?? '')),
            'review_text' => trim((string) ($data['review_text'] ?? '')),
        ];

        if ($userId !== null) {
            $values['user_id'] = $userId;
        }

        return $values;
    }
}
