<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Equipamento extends Model
{
    public $timestamps = false;

    protected $fillable = [
        "numero_serie",
        "numero_patrimonio",
        "nome",
        "id_cliente"
    ];

    public function cliente(): BelongsTo{
        return $this->belongsTo(Cliente::class, 'id_cliente');
    }
}
