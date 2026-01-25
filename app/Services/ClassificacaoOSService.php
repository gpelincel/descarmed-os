<?php

namespace App\Services;

use App\Models\ClassificacaoOS;

class ClassificacaoOSService
{
    public function findByID(string $id)
    {
        return ClassificacaoOS::findOrFail($id);
    }

    public function getAtivos()
    {
        return ClassificacaoOS::all()->where('ativo', '=', '1');
    }

    public function getAll()
    {
        return ClassificacaoOS::all();
    }

    public function save(Array $classificacao)
    {
        $classificacao = ClassificacaoOS::create($classificacao);

        return $classificacao;
    }

    public function delete(string $id){
        $classificacao = ClassificacaoOS::findOrFail($id);
        $classificacao->delete();

        return $classificacao;
    }

    public function edit(Array $novoClassificacaoOS){
        $classificacao = ClassificacaoOS::findOrFail($novoClassificacaoOS['id_classificacao']);
        $classificacao->update($novoClassificacaoOS);
        return $classificacao;
    }
}
