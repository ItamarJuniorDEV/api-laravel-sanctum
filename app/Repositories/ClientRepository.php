<?php

namespace App\Repositories;

use App\Models\Client;

class ClientRepository
{
    public function findAll()
    {
        return Client::all();
    }

    public function findById($id)
    {
        return Client::find($id);
    }

    public function create($data)
    {
        return Client::create($data);
    }

    public function update(Client $client, $data)
    {
        $client->update($data);

        return $client;
    }

    public function delete(Client $client)
    {
        $client->delete();
    }
}
