<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    public $timestamps = false;

    protected $fillable = [
        "quantidade",
        "nome",
        "valor_unitario",
        "id_os",
        "id_unidade"
    ];

    public function unidade(){
        return $this->belongsTo(Unidade::class, 'id_unidade');
    }
}
