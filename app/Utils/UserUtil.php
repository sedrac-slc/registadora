<?php

namespace App\Utils;

class UserUtil{

    public static function genders(){
        return ['MALE' => 'Masculino','FEMALE' => 'Femenino'];
    }

    public static function keysGenders(){
        return array_keys(UserUtil::genders());
    }

    public static function generatorFaker(){
        $options = UserUtil::keysGenders();
        $index = rand(0, sizeof($options) - 1);
        $key = $options[$index];
        return [
            'name'  => fake()->name($gender = $key),
            'email'  => fake()->unique()->safeEmail(),
            'phone' => fake()->phoneNumber(),
            'gender' => $options[$index],
            'birthday' => fake()->date(),
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi'
        ];
    }

}
