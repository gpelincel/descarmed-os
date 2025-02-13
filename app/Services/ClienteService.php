<?php

namespace App\Services;

use App\Models\Cliente;

class ClienteService
{
    public function findByID(string $id)
    {
        return Cliente::findOrFail($id);
    }

    public function getAll()
    {
        return Cliente::query()->get();
    }

    public function save(Array $cliente)
    {
        $cliente = Cliente::create($cliente);

        return $cliente;
    }

    public function delete(string $id){
        $cliente = Cliente::findOrFail($id);
        $cliente->delete();

        return $cliente;
    }

    public function edit(Array $novoCliente, string $id){
        $cliente = Cliente::findOrFail($id);
        $cliente->update($novoCliente);
        return $cliente;
    }
}
