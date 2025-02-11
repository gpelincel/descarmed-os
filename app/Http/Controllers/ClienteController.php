<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use App\Http\Requests\StoreClienteRequest;
use App\Services\ClienteService;
use Illuminate\Routing\Route;

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
        if (request()->wantsJson()) {
            return $clientes;
        }

        return view('clientes', compact('clientes'));
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

        if (request()->wantsJson()) {
            return $cliente;
        }

        return redirect()->back()->with('status', 'success')->with('message','Cliente cadastrado com sucesso!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $cliente = $this->clienteService->findByID($id);

        if (request()->wantsJson()) {
            return $cliente;
        }

        return view('cliente-info', compact('cliente'));
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
        if (request()->wantsJson()) {
            return response()->json(['message' => 'Cliente atualizado com sucesso', 'data' => $cliente], 200);
        }

        return redirect()->back()->with('status', 'success')->with('message','Cliente atualizado com sucesso!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $cliente = $this->clienteService->delete($id);

        if (request()->wantsJson()) {
            return response()->json(['message' => 'Cliente deletado com sucesso', 'data' => $cliente], 200);
        }

        return redirect('/cliente')->with('status', 'success')->with('message','Cliente deletado com sucesso!');
    }
}
