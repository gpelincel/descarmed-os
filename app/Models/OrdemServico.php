<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Models\Equipamento;

class OrdemServico extends Model {
    protected $fillable = [
        "titulo",
        "descricao",
        "status",
        "data",
        "id_equipamento"
    ];

    public function equipamento(): BelongsTo{
        return $this->belongsTo(Equipamento::class, 'id_equipamento');
    }
}
