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
        "id_os"
    ];
}
