<?php

namespace App\Repositories\Contracts;

use App\Models\Client;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

interface ClientRepositoryInterface {
    public function paginateForUser(int $userId, int $perPage = 10): LengthAwarePaginator;
    public function allForUser(int $userId);
    public function findForUser(int $userId, int $id): ?Client;
    public function create(array $data): Client;
    public function update(Client $client, array $data): Client;
    public function delete(Client $client): void;
}
