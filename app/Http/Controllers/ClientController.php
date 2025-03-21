<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Services\ApiResponse;
use Illuminate\Http\Request;

class ClientController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // if(!auth()->user()->tokenCan('clients:list')) {
        //    return ApiResponse::error('Acesso negado', 401);
        // }
        //
        return ApiResponse::success(Client::all());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:clients',
            'phone' => 'required'
        ]); 

        $client = Client::create($request->all());

        return ApiResponse::success($client);
        
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        if(!auth()->user()->tokenCan('clients:detail')) {
            return ApiResponse::error('Acesso negado', 401);    
        }
        
        $client = Client::find($id);

        if ($client) {
            return ApiResponse::success($client);
        } else {
            return ApiResponse::error('Cliente não encontrado', 404);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:clients,email,'.$id,
            'phone' => 'required'
        ]); 

        $client = Client::find($id);

        if ($client) {
            $client->update($request->all());
            return ApiResponse::success($client);
        } else {
            return ApiResponse::error('Cliente não encontrado');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $client = Client::find($id);

        if ($client) {
            $client->delete();
            return ApiResponse::success('Cliente deletado com sucesso');
        } else {
            return ApiResponse::error('Cliente não encontrado');
        }
    }
}