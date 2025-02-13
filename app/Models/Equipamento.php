<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Equipamento extends Model
{
    protected $fillable = [
        "codigo",
        "nome",
        "id_cliente"
    ];

    public function cliente(): BelongsTo{
        return $this->belongsTo(Cliente::class, 'id_cliente');
    }
}
