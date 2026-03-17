<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreClientRequest;
use App\Http\Requests\UpdateClientRequest;
use App\Http\Resources\ClientResource;
use App\Services\ApiResponse;
use App\Services\ClientService;

class ClientController extends Controller
{
    public function __construct(private ClientService $service)
    {
    }

    public function index()
    {
        if (!auth()->user()->tokenCan('clients:list')) {
            return ApiResponse::error('Acesso negado', 401);
        }

        $clients = $this->service->getAll();

        return ApiResponse::success(ClientResource::collection($clients)->toArray(request()));
    }

    public function store(StoreClientRequest $request)
    {
        if (!auth()->user()->tokenCan('clients:detail')) {
            return ApiResponse::error('Acesso negado', 401);
        }

        $client = $this->service->create($request->validated());

        return ApiResponse::success((new ClientResource($client))->toArray(request()));
    }

    public function show($id)
    {
        if (!auth()->user()->tokenCan('clients:detail')) {
            return ApiResponse::error('Acesso negado', 401);
        }

        $client = $this->service->getById($id);

        if (!$client) {
            return ApiResponse::error('Cliente não encontrado', 404);
        }

        return ApiResponse::success((new ClientResource($client))->toArray(request()));
    }

    public function update(UpdateClientRequest $request, $id)
    {
        if (!auth()->user()->tokenCan('clients:detail')) {
            return ApiResponse::error('Acesso negado', 401);
        }

        $client = $this->service->update($id, $request->validated());

        if (!$client) {
            return ApiResponse::error('Cliente não encontrado', 404);
        }

        return ApiResponse::success((new ClientResource($client))->toArray(request()));
    }

    public function destroy($id)
    {
        if (!auth()->user()->tokenCan('clients:detail')) {
            return ApiResponse::error('Acesso negado', 401);
        }

        $deleted = $this->service->delete($id);

        if (!$deleted) {
            return ApiResponse::error('Cliente não encontrado', 404);
        }

        return ApiResponse::success('Cliente deletado com sucesso');
    }
}
