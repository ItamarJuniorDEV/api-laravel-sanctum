<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreClientRequest;
use App\Http\Requests\UpdateClientRequest;
use App\Http\Resources\ClientResource;
use App\Services\ApiResponse;
use App\Services\ClientService;
use Throwable;

class ClientController extends Controller
{
    public function __construct(private ClientService $service) {}

    public function index()
    {
        if (! auth()->user()->tokenCan('clients:list')) {
            return ApiResponse::error('Acesso negado!', 401);
        }

        try {
            $clients = $this->service->getAll();

            return ApiResponse::success([
                'clients' => ClientResource::collection($clients->items())->toArray(request()),
                'total' => $clients->total(),
                'current_page' => $clients->currentPage(),
                'last_page' => $clients->lastPage(),
            ], 'Clientes listados com sucesso!');

        } catch (Throwable $e) {
            report($e);

            return ApiResponse::error('Erro interno no servidor ao tentar listar os clientes!');
        }
    }

    public function store(StoreClientRequest $request)
    {
        if (! auth()->user()->tokenCan('clients:detail')) {
            return ApiResponse::error('Acesso negado!', 401);
        }

        try {
            $client = $this->service->create($request->validated());

            return ApiResponse::success(
                (new ClientResource($client))->toArray(request()),
                'Cliente criado com sucesso!'
            );

        } catch (Throwable $e) {
            report($e);

            return ApiResponse::error('Erro interno no servidor ao tentar criar o cliente!');
        }
    }

    public function show(int $id)
    {
        if (! auth()->user()->tokenCan('clients:detail')) {
            return ApiResponse::error('Acesso negado!', 401);
        }

        try {
            $client = $this->service->getById($id);

            if (! $client) {
                return ApiResponse::error('Cliente não encontrado!', 404);
            }

            return ApiResponse::success(
                (new ClientResource($client))->toArray(request()),
                'Cliente encontrado com sucesso!'
            );

        } catch (Throwable $e) {
            report($e);

            return ApiResponse::error('Erro interno no servidor ao tentar buscar o cliente!');
        }
    }

    public function update(UpdateClientRequest $request, int $id)
    {
        if (! auth()->user()->tokenCan('clients:detail')) {
            return ApiResponse::error('Acesso negado!', 401);
        }

        try {
            $client = $this->service->update($id, $request->validated());

            if (! $client) {
                return ApiResponse::error('Cliente não encontrado!', 404);
            }

            return ApiResponse::success(
                (new ClientResource($client))->toArray(request()),
                'Cliente atualizado com sucesso!'
            );

        } catch (Throwable $e) {
            report($e);

            return ApiResponse::error('Erro interno no servidor ao tentar atualizar o cliente!');
        }
    }

    public function destroy(int $id)
    {
        if (! auth()->user()->tokenCan('clients:detail')) {
            return ApiResponse::error('Acesso negado!', 401);
        }

        try {
            $deleted = $this->service->delete($id);

            if ($deleted === null) {
                return ApiResponse::error('Cliente não encontrado!', 404);
            }

            return ApiResponse::success(null, 'Cliente excluído com sucesso!');

        } catch (Throwable $e) {
            report($e);

            return ApiResponse::error('Erro interno no servidor ao tentar excluir o cliente!');
        }
    }
}
