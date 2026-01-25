<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ClassificacaoOS extends Model {
    public $timestamps = false;
    protected $fillable = [
        'ativo',
        "descricao",
    ];
    protected $table = 'classificacao_os';

    public function ordemServico() {
        return $this->hasMany(OrdemServico::class, 'classificacao');
    }
}
