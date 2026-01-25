<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Unidade extends Model
{
    protected $fillable = [
        'ativo',
        'descricao',
    ];

    public $timestamps = false;

    public function item(){
        return $this->hasMany(Item::class, 'id_unidade');
    }
}
