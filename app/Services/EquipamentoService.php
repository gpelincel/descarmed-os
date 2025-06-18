<?php

namespace App\Services;

use App\Models\Equipamento;

class EquipamentoService
{
    public function findByID(string $id)
    {
        return Equipamento::findOrFail($id);
    }

    public function getAll()
    {
        return Equipamento::with(['cliente']);
    }

    public function save(Array $equipamento)
    {
        $equipamento = Equipamento::create($equipamento);

        return $equipamento;

    }

    public function delete(string $id){
        $equipamento = Equipamento::findOrFail($id);
        $equipamento->delete();

        return $equipamento;
    }

    public function edit(Array $novoEquipamento, string $id){
        $equipamento = Equipamento::findOrFail($id);
        $equipamento->update($novoEquipamento);
        return $equipamento;
    }
}
