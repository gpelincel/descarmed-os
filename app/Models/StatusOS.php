<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StatusOS extends Model
{
    protected $fillable = [
        'ativo',
        'descricao',
    ];

    public $timestamps = false;

    protected $table = 'status_os';

    public function ordemServico(){
        return $this->hasMany(OrdemServico::class, 'status');
    }
}
