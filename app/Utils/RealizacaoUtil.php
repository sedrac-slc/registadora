<?php

namespace App\Utils;


class RealizacaoUtil{

    public static function diaSemana(){
        return [
            'DOMINGO' => 'Domingo',
            'SEGUNDA' => 'Segunda feira',
            'TERCA' => 'Terça feira',
            'QUARTA' => 'Quarta feira',
            'QUINTA' => 'Quinta feira',
            'SEXTA' => 'Sexta feira',
            'SABADO' => 'Sabado'
        ];
    }

    public static function keysDiaSemana(){
        return array_keys(RealizacaoUtil::diaSemana());
    }

    public static function generatorFaker($servico, $funcionario){
        $arraysDias = RealizacaoUtil::keysDiaSemana();
        unset($arraysDias['SABADO'], $arraysDias['DOMINGO']);
        $index = rand(0, sizeof($arraysDias) - 1 );
        $key = $arraysDias[$index];
        return [
            'servico_id' => $servico->id,
            'dia_semana' => $key,
            'hora_abertura' => fake()->time(),
            'hora_termino' => fake()->time(),
            'created_by' => $funcionario->user_id,
            'updated_by' => $funcionario->user_id
        ];
    }

}
