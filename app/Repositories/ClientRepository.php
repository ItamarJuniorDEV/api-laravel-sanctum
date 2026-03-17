<?php

namespace App\Repositories;

use App\Models\Client;

class ClientRepository implements ClientRepositoryInterface
{
    public function findAll(int $perPage = 15)
    {
        return Client::paginate($perPage);
    }

    public function findById($id)
    {
        return Client::find($id);
    }

    public function create(array $data)
    {
        return Client::create($data);
    }

    public function update(Client $client, array $data)
    {
        $client->update($data);

        return $client;
    }

    public function delete(Client $client): void
    {
        $client->delete();
    }
}
