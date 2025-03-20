<?php

namespace App\Http\Controllers;

use App\Models\Client;
use Illuminate\Http\Request;

class ClientController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return response()->json(Client::all(),200);
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

        return response()->json([
            'message' => 'Cliente criado com sucesso',
            'data' => $client,
        ], 200);
        
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $client = Client::find($id);

        if ($client) {
            return response()->json($client, 200);
        } else {
            return response()->json([
                'message' => 'Cliente não encontrado'], 404);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // atualizar
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        // excluir
    }
}