<?php
declare(strict_types=1);

namespace App\Controllers;

use App\Core\Auth;
use App\Models\Review;

class ReviewController
{
    private Review $review;

    public function __construct()
    {
        $this->review = new Review();
    }

    public function all(): array
    {
        return $this->review->all();
    }

    public function find(int $id): ?array
    {
        return $this->review->find($id);
    }

    public function validate(array $data): array
    {
        $errors = [];
        $rating = (int) ($data['rating'] ?? 0);

        if ($rating < 1 || $rating > 5) {
            $errors[] = 'Please choose a rating from 1 to 5.';
        }

        if (trim((string) ($data['review_text'] ?? '')) === '') {
            $errors[] = 'Review text is required.';
        }

        return $errors;
    }

    public function create(array $data): bool
    {
        $userId = Auth::memberId();

        return $userId !== null && $this->review->create($userId, $data);
    }

    public function update(int $id, array $data): bool
    {
        return $this->review->update($id, $data);
    }

    public function delete(int $id): bool
    {
        return $this->review->delete($id);
    }

    public function canManage(array $review): bool
    {
        if (Auth::check()) {
            return true;
        }

        return Auth::memberId() !== null && (int) $review['user_id'] === Auth::memberId();
    }
}
