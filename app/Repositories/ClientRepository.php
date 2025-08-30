<?php

namespace App\Repositories;

use App\Models\Client;
use App\Repositories\Contracts\ClientRepositoryInterface;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class ClientRepository implements ClientRepositoryInterface
{
     public function paginateForUser(int $userId, int $perPage = 10): LengthAwarePaginator
    {
        return Client::where('user_id', $userId)
            ->latest()
            ->paginate($perPage);
    }

    public function allForUser(int $userId) {
        return Client::where('user_id',$userId)->orderBy('name')->get();
    }

    public function findForUser(int $userId, int $id): ?Client {
        return Client::where('user_id',$userId)->where('id',$id)->first();
    }

    public function create(array $data): Client {
        return Client::create($data);
    }

    public function update(Client $client, array $data): Client {
        $client->update($data);
        return $client;
    }

    public function delete(Client $client): void {
        $client->delete();
    }
}
