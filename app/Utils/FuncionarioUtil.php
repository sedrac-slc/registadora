<?php

namespace App\Utils;

use Illuminate\Support\Facades\Auth;

class FuncionarioUtil{

    public static function isAuth(){
        return isset(Auth::user()->funcionario->id);
    }

    public static function tipos(){
        return [
            'DIRECTOR' => 'Director',
            'SECRETARIO' => 'Secretário',
            'GERENTE' => 'Gerente'
        ];
    }

    public static function keysTipos(){
        return array_keys(FuncionarioUtil::tipos());
    }

    public static function generatorFaker($user){
        $options = FuncionarioUtil::keysTipos();
        $index = rand(0, sizeof($options) - 1);
        $key = $options[$index];
        return [
            'user_id' => $user->id,
            'tipo' => $key,
            'created_by' => $user->id,
            'updated_by' => $user->id
        ];
    }

}
