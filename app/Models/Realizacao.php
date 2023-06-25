<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Realizacao extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'servico_id',
        'dia_semana',
        'hora_abertura',
        'hora_termino',
        'created_by',
        'updated_by'
    ];

    public function servico() {
        return $this->belongsTo(Servico::class);
    }

}
