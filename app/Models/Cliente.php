<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{
    public $timestamps = false;

    protected $fillable = [
        "nome",
        "razao_social",
        "cnpj",
        "email",
        "telefone"
    ];

    public function ordens_servico(){
        return $this->hasMany(OrdemServico::class, 'id_cliente');
    }

    public function equipamentos(){
        return $this->hasMany(Equipamento::class, 'id_cliente');
    }

    public function endereco(){
        return $this->hasOne(Endereco::class, 'id_cliente');
    }

    protected function enderecoFormated(): Attribute
    {
        return Attribute::make(
            get: function () {
                $endereco = $this->endereco;

                if (!$endereco) {
                    return 'Endereço não cadastrado';
                }

                $partes = [
                    $endereco->logradouro,
                    $endereco->numero,
                    $endereco->complemento,
                    $endereco->bairro,
                    $endereco->cidade,
                    $endereco->estado
                ];

                return implode(', ', array_filter($partes));
            }
        );
    }
}
