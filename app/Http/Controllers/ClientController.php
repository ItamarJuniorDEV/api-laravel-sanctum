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
        // listar
        return response()->json(Client::all(),200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //adicionar
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        // mostrar 1 cliente específico
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
