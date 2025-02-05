<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class OrdemServico extends Model {
    protected $fillable = [
        "titulo",
        "descricao",
        "status",
        "data",
        "id_cliente"
    ];

    public function cliente(): BelongsTo{
        return $this->belongsTo(Cliente::class, 'id_cliente');
    }
}
