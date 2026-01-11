<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Anexo extends Model
{
    public $timestamps = false;
    protected $fillable = [
        "path",
        "id_os"
    ];
    
    protected $table = 'anexo';
}
