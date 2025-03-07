<?php

namespace App\Services;

use App\Models\Cliente;
use App\Models\Endereco;
use App\Models\Equipamento;

class ClienteService
{
    public function findByID(string $id)
    {
        return Cliente::with('endereco')->findOrFail($id);
    }

    public function findEquipamentos(string $id){
        return Equipamento::where('id_cliente', $id)->get();
    }

    public function getAll()
    {
        return Cliente::query();
    }

    public function save(Array $cliente)
    {
        $clienteReturn = Cliente::create($cliente);

        $cliente['id_cliente'] = $clienteReturn->id;

        $enderecoService = new EnderecoService();
        $endereco = $enderecoService->save($cliente);
        $clienteReturn->endereco = $endereco;

        return $clienteReturn;
    }

    public function delete(string $id){
        $cliente = Cliente::findOrFail($id);
        $cliente->delete();

        return $cliente;
    }

    public function edit(Array $novoCliente, string $id){
        $cliente = Cliente::findOrFail($id);
        $cliente->update($novoCliente);

        $enderecoService = new EnderecoService();
        $novoCliente['id_cliente'] = $id;

        $endereco = $enderecoService->edit($novoCliente);
        $cliente->endereco = $endereco;

        return $cliente;
    }
}
