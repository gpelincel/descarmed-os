<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Agenda extends Model
{
    public $timestamps = false;

    protected $fillable = [
        "data",
        "id_os",
        "data_aviso"
    ];

    public function ordem_servico(){
        return $this->belongsTo(OrdemServico::class, 'id_os');
    }
}
