<?php

namespace App\Services;

use App\Models\Client;
use App\Repositories\Contracts\ClientRepositoryInterface;

class ClientService
{
    public function __construct(private ClientRepositoryInterface $clients) {}

    public function paginate(int $userId, int $perPage = 10) {
        return $this->clients->paginateForUser($userId,$perPage);
    }

    public function all(int $userId) {
        return $this->clients->allForUser($userId);
    }

    public function create(int $userId, array $data): Client {
        $data['user_id'] = $userId;
        return $this->clients->create($data);
    }

    public function update(Client $client, array $data): Client {
        return $this->clients->update($client,$data);
    }

    public function delete(Client $client): void {
        $this->clients->delete($client);
    }
}
