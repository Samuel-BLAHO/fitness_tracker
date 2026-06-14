<?php
declare(strict_types=1);

namespace App\Controllers;

use App\Models\Service;

class ServiceController
{
    private Service $service;

    public function __construct()
    {
        $this->service = new Service();
    }

    public function publicServices(): array
    {
        return $this->service->all(true);
    }

    public function adminServices(): array
    {
        return $this->service->all(false);
    }

    public function validate(array $data): array
    {
        $errors = [];

        if (trim((string) ($data['title'] ?? '')) === '') {
            $errors[] = 'Service title is required.';
        }

        if (trim((string) ($data['image'] ?? '')) === '') {
            $errors[] = 'Image path is required.';
        }

        return $errors;
    }

    public function create(array $data): bool
    {
        return $this->service->create($data);
    }

    public function update(int $id, array $data): bool
    {
        return $this->service->update($id, $data);
    }

    public function delete(int $id): bool
    {
        return $this->service->delete($id);
    }

    public function find(int $id): ?array
    {
        return $this->service->find($id);
    }
}

