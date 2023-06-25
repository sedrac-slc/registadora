<?php

namespace App\Utils;

class ServicoUtil{

    public static function generatorFaker($funcionario){
        return [
            'nome' => fake()->unique()->name(),
            'descricao' => fake()->realText(),
            'preco' => fake()->randomFloat(),
            'created_by' => $funcionario->user_id,
            'updated_by' => $funcionario->user_id
        ];
    }

}
