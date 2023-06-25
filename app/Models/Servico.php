<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Servico extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'nome',
        'descricao',
        'preco',
        'created_by',
        'updated_by'
    ];

    public function realizacaos(){
        return $this->hasMany(Realizacao::class);
    }

    public function clientes(){
        return $this->belongsToMany(Cliente::class);
    }

}
