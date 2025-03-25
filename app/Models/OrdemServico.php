<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Models\Equipamento;

class OrdemServico extends Model {
    protected $fillable = [
        "titulo",
        "descricao",
        "id_status",
        "id_classificacao",
        "data_inicio",
        "data_conclusao",
        "preco",
        "id_equipamento"
    ];

    public function equipamento(): BelongsTo {
        return $this->belongsTo(Equipamento::class, 'id_equipamento');
    }

    public function getClassificacao() {
        switch ($this->classificacao) {
            case 1:
                return "Orçamento";
                break;
            case 2:
                return "Ordem de Serviço";
                break;
            case 3:
                return "Relatório de Manutenção";
                break;
        }
    }

    public function status():BelongsTo {
        return $this->belongsTo(StatusOS::class, 'id_status');
    }

    public function classificacao():BelongsTo {
        return $this->belongsTo(ClassificacaoOS::class, 'id_classificacao');
    }
}
