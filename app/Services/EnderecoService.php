<?php

namespace App\Services;

use App\Models\Endereco;

class EnderecoService
{
    public function findByID(string $id)
    {
        return Endereco::findOrFail($id);
    }

    public function getAll()
    {
        return Endereco::query();
    }

    public function save(Array $endereco)
    {
        $endereco = Endereco::create($endereco);

        return $endereco;
    }

    public function delete(string $id){
        $endereco = Endereco::findOrFail($id);
        $endereco->delete();

        return $endereco;
    }

    public function edit(Array $novoEndereco){
        $endereco = Endereco::findOrFail($novoEndereco['id_cliente']);
        $endereco->update($novoEndereco);
        return $endereco;
    }
}
