<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use App\Http\Requests\StoreClienteRequest;
use App\Http\Requests\UpdateClienteRequest;
use App\Services\ClienteService;

class ClienteController extends Controller
{

    protected $clienteService;

    public function __construct(ClienteService $clienteService)
    {
        $this->clienteService = $clienteService;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $clientes = $this->clienteService->getAll();

        return $clientes;
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreClienteRequest $request)
    {
        $cliente = $this->clienteService->save($request->all());

        return $cliente;
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $cliente = $this->clienteService->findByID($id);

        return $cliente;
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Cliente $cliente)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StoreClienteRequest $request, string $id)
    {
        $cliente = $this->clienteService->edit($request->all(), $id);
        return $cliente;
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $cliente = $this->clienteService->delete($id);

        return response()->json(['message' => 'Cliente deletado com sucesso', 'data' => $cliente], 200);
    }
}
