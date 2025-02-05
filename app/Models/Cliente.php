<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{
    public $timestamps = false;

    protected $fillable = [
        "nome",
        "razao_social",
        "cnpj",
        "email",
        "telefone"
    ];

    public function ordens_servico(){
        return $this->hasMany(OrdemServico::class, 'id_cliente');
    }
}
