<?php

namespace App\Services;

use App\Repositories\ClientRepository;

class ClientService
{
    public function __construct(private ClientRepository $repository) {}

    public function getAll()
    {
        return $this->repository->findAll();
    }

    public function getById($id)
    {
        return $this->repository->findById($id);
    }

    public function create($data)
    {
        return $this->repository->create($data);
    }

    public function update($id, $data)
    {
        $client = $this->repository->findById($id);

        if (! $client) {
            return null;
        }

        return $this->repository->update($client, $data);
    }

    public function delete($id)
    {
        $client = $this->repository->findById($id);

        if (! $client) {
            return false;
        }

        $this->repository->delete($client);

        return true;
    }
}
