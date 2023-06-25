<?php

namespace App\Utils;

use Illuminate\Support\Facades\Auth;

class ClienteUtil{

    public static function isAuth(){
        return isset(Auth::user()->cliente->id);
    }

    public static function generatorFaker($user){
        return [
            'user_id' => $user->id,
            'quantidade_servico' => 0,
            'created_by' => $user->id,
            'updated_by' => $user->id
        ];;
    }

}
