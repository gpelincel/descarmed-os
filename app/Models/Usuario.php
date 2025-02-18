<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Usuario extends Model
{
    protected $fillable = [
        'nome',
        'usuario',
        'senha',
    ];

    protected $hidden = [
        'senha'
    ];
}
