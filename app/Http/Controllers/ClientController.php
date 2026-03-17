<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Services\ApiResponse;
use Illuminate\Http\Request;

class ClientController extends Controller
{
    public function index()
    {
        if (!auth()->user()->tokenCan('clients:list')) {
            return ApiResponse::error('Acesso negado', 401);
        }

        return ApiResponse::success(Client::all());
    }

    public function store(Request $request)
    {
        if (!auth()->user()->tokenCan('clients:detail')) {
            return ApiResponse::error('Acesso negado', 401);
        }

        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:clients',
            'phone' => 'required'
        ]);

        $client = Client::create($request->all());

        return ApiResponse::success($client);
    }

    public function show($id)
    {
        if (!auth()->user()->tokenCan('clients:detail')) {
            return ApiResponse::error('Acesso negado', 401);
        }

        $client = Client::find($id);

        if (!$client) {
            return ApiResponse::error('Cliente não encontrado', 404);
        }

        return ApiResponse::success($client);
    }

    public function update(Request $request, $id)
    {
        if (!auth()->user()->tokenCan('clients:detail')) {
            return ApiResponse::error('Acesso negado', 401);
        }

        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:clients,email,'.$id,
            'phone' => 'required'
        ]);

        $client = Client::find($id);

        if (!$client) {
            return ApiResponse::error('Cliente não encontrado', 404);
        }

        $client->update($request->all());

        return ApiResponse::success($client);
    }

    public function destroy($id)
    {
        if (!auth()->user()->tokenCan('clients:detail')) {
            return ApiResponse::error('Acesso negado', 401);
        }

        $client = Client::find($id);

        if (!$client) {
            return ApiResponse::error('Cliente não encontrado', 404);
        }

        $client->delete();

        return ApiResponse::success('Cliente deletado com sucesso');
    }
}