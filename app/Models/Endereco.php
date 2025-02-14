<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Endereco extends Model
{
    public $timestamps = false;

    protected $fillable = [
        "cep",
        "logradouro",
        "numero",
        "complemento",
        "bairro",
        "cidade",
        "estado",
        "id_cliente"
    ];

    public function cliente(): BelongsTo{
        return $this->belongsTo(Cliente::class, 'id_cliente');
    }
}
