<?php

namespace App\Services;

use App\Http\Requests\StoreUpdateEndereco;
use App\Models\Cliente;
use App\Models\Endereco;
use App\Models\Equipamento;

class ClienteService
{
    protected $enderecoService;

    public function __construct(EnderecoService $enderecoService)
    {
        $this->enderecoService = $enderecoService;
    }

    public function findByID(string $id)
    {
        return Cliente::with('endereco', 'ordens_servico', 'equipamentos')->findOrFail($id);
    }

    public function getAll()
    {
        return Cliente::query();
    }

    public function save(Array $cliente)
    {
        $clienteReturn = Cliente::create($cliente);

        $cliente['id_cliente'] = $clienteReturn->id;

        $enderecoRequest = new StoreUpdateEndereco($cliente);
        $endereco = $this->enderecoService->save($enderecoRequest);
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
