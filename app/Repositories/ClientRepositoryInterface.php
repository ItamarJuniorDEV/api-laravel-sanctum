<?php

namespace App\Repositories;

use App\Models\Client;

interface ClientRepositoryInterface
{
    public function findAll(int $perPage);

    public function findById($id);

    public function create(array $data);

    public function update(Client $client, array $data);

    public function delete(Client $client): void;
}
