<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Models\Equipamento;
use Illuminate\Database\Eloquent\Relations\HasMany;

class OrdemServico extends Model {
    protected $fillable = [
        "titulo",
        "descricao",
        "codigo_compra",
        "nota_fiscal",
        "data_inicio",
        "data_conclusao",
        "preco",
        "id_status",
        "id_cliente",
        "id_classificacao",
        "id_equipamento"
    ];

    public function cliente() {
        return $this->belongsTo(Cliente::class, 'id_cliente');
    }

    public function equipamento() {
        return $this->belongsTo(Equipamento::class, 'id_equipamento');
    }

    public function status(): BelongsTo {
        return $this->belongsTo(StatusOS::class, 'id_status');
    }

    public function classificacao(): BelongsTo {
        return $this->belongsTo(ClassificacaoOS::class, 'id_classificacao');
    }

    public function items(): HasMany{
        return $this->hasMany(Item::class, 'id_os');
    }
}