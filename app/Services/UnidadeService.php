<?php

namespace App\Services;

use App\Models\Unidade;

class UnidadeService
{
    public function findByID(string $id)
    {
        return Unidade::findOrFail($id);
    }

    public function getAll()
    {
        return Unidade::all();
    }

    public function save(Array $unidade)
    {
        $unidade = Unidade::create($unidade);

        return $unidade;
    }

    public function delete(string $id){
        $unidade = Unidade::findOrFail($id);
        $unidade->delete();

        return $unidade;
    }

    public function edit(Array $novoUnidade){
        $unidade = Unidade::findOrFail($novoUnidade['id_unidade']);
        $unidade->update($novoUnidade);
        return $unidade;
    }
}
