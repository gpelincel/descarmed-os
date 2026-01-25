<?php

namespace App\Services;

use App\Models\StatusOS;

class StatusOSService
{
    public function findByID(string $id)
    {
        return StatusOS::findOrFail($id);
    }

    public function getAll()
    {
        return StatusOS::all();
    }

    public function getAtivos()
    {
        return StatusOS::all()->where('ativo', '=', '1');
    }

    public function save(Array $status)
    {
        $status = StatusOS::create($status);

        return $status;
    }

    public function delete(string $id){
        $status = StatusOS::findOrFail($id);
        $status->delete();

        return $status;
    }

    public function edit(Array $novoStatusOS){
        $status = StatusOS::findOrFail($novoStatusOS['id_status']);
        $status->update($novoStatusOS);
        return $status;
    }
}
