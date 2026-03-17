<?php

namespace App\Services;

use App\Repositories\ClientRepositoryInterface;

class ClientService
{
    public function __construct(private ClientRepositoryInterface $repository) {}

    public function getAll(int $perPage = 15)
    {
        return $this->repository->findAll($perPage);
    }

    public function getById($id)
    {
        return $this->repository->findById($id);
    }

    public function create(array $data)
    {
        return $this->repository->create($data);
    }

    public function update($id, array $data)
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
            return null;
        }

        $this->repository->delete($client);

        return true;
    }
}
