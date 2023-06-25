<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\{
    User,
    Cliente,
    Servico,
    Funcionario,
    Realizacao
};
use App\Utils\{
    UserUtil,
    ClienteUtil,
    ServicoUtil,
    FuncionarioUtil,
    RealizacaoUtil
};
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {

        $tam = 15;
        $users = [];
        for($i=0; $i < $tam; $i++)
            $users[] = User::create(UserUtil::generatorFaker());

        $clientes = [];
        $funcionarios = [];
        for($i=0; $i < $tam; $i++){
            $i % 2 == 0
            ? $clientes[] = Cliente::create(ClienteUtil::generatorFaker($users[$i]))
            : $funcionarios[] = Funcionario::create(FuncionarioUtil::generatorFaker($users[$i]));
        }

        $servicos = [];
        $funcTam = sizeof($funcionarios);
        for($i=0; $i < $tam; $i++){
            $index = rand(0, $funcTam - 1);
            $servicos[] = Servico::create(ServicoUtil::generatorFaker($funcionarios[$index]));
        }

        $realizacoes = [];
        $servTam = sizeof($servicos);
        for($i=0; $i < $tam; $i++){
            $funcIndex = rand(0, $funcTam - 1);
            $servIndex = rand(0, $servTam - 1);
            $realIndex = rand(0, 5);
            $j = 0;
            while( $j < $realIndex){
                $data = RealizacaoUtil::generatorFaker($servicos[$servIndex],$funcionarios[$funcIndex]);
                if($data['dia_semana'] != "SABADO" && $data['dia_semana'] != "DOMINGO") {
                    $realizacoes[] = Realizacao::updateOrCreate([
                        "servico_id"=>$data['servico_id'],
                        "dia_semana"=>$data['dia_semana']
                    ],$data);
                    $j++;
                }
            }
        }

    }
}
