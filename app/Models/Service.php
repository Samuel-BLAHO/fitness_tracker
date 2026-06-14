<?php
declare(strict_types=1);

namespace App\Models;

use App\Core\Database;
use PDOException;

class Service
{
    public function all(bool $onlyActive = false): array
    {
        try {
            $sql = 'SELECT * FROM services';

            if ($onlyActive) {
                $sql .= ' WHERE is_active = 1';
            }

            $sql .= ' ORDER BY sort_order ASC, id ASC';

            return Database::connection()->query($sql)->fetchAll();
        } catch (PDOException) {
            return self::fallbackServices();
        }
    }

    public function find(int $id): ?array
    {
        $statement = Database::connection()->prepare('SELECT * FROM services WHERE id = :id LIMIT 1');
        $statement->execute(['id' => $id]);
        $service = $statement->fetch();

        return $service ?: null;
    }

    public function create(array $data): bool
    {
        $statement = Database::connection()->prepare(
            'INSERT INTO services (title, description, image, sort_order, is_active)
             VALUES (:title, :description, :image, :sort_order, :is_active)'
        );

        return $statement->execute($this->cleanData($data));
    }

    public function update(int $id, array $data): bool
    {
        $values = $this->cleanData($data);
        $values['id'] = $id;

        $statement = Database::connection()->prepare(
            'UPDATE services
             SET title = :title, description = :description, image = :image, sort_order = :sort_order, is_active = :is_active
             WHERE id = :id'
        );

        return $statement->execute($values);
    }

    public function delete(int $id): bool
    {
        $statement = Database::connection()->prepare('DELETE FROM services WHERE id = :id');

        return $statement->execute(['id' => $id]);
    }

    public static function fallbackServices(): array
    {
        return [
            ['id' => 1, 'title' => 'CROSSFIT TRAINING', 'description' => 'High-intensity workouts for strength and stamina.', 'image' => 'images/s-1.jpg', 'sort_order' => 1, 'is_active' => 1],
            ['id' => 2, 'title' => 'FITNESS', 'description' => 'Balanced gym training for everyday fitness.', 'image' => 'images/s-2.jpg', 'sort_order' => 2, 'is_active' => 1],
            ['id' => 3, 'title' => 'DYNAMIC STRENGTH TRAINING', 'description' => 'Strength sessions focused on safe progress.', 'image' => 'images/s-3.jpg', 'sort_order' => 3, 'is_active' => 1],
            ['id' => 4, 'title' => 'HEALTH', 'description' => 'Fitness habits that support a healthier lifestyle.', 'image' => 'images/s-4.jpg', 'sort_order' => 4, 'is_active' => 1],
            ['id' => 5, 'title' => 'WORKOUT', 'description' => 'Guided workouts for different training goals.', 'image' => 'images/s-5.jpg', 'sort_order' => 5, 'is_active' => 1],
            ['id' => 6, 'title' => 'STRATEGIES', 'description' => 'Personal training plans and progress strategies.', 'image' => 'images/s-6.jpg', 'sort_order' => 6, 'is_active' => 1],
        ];
    }

    private function cleanData(array $data): array
    {
        return [
            'title' => trim((string) ($data['title'] ?? '')),
            'description' => trim((string) ($data['description'] ?? '')),
            'image' => trim((string) ($data['image'] ?? 'images/s-1.jpg')),
            'sort_order' => (int) ($data['sort_order'] ?? 0),
            'is_active' => isset($data['is_active']) ? 1 : 0,
        ];
    }
}

