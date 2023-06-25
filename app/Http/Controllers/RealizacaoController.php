<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Realizacao;
use App\Models\Servico;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use PhpParser\Node\Expr\Throw_;

class RealizacaoController extends Controller
{

    public function index(Request $request){
        if(isset($request->servico)){
            $servico = Servico::find($request->servico);
            return $servico->realizacaos;
        }
    }

    public function update(Request $request, $id)
    {
        try {
            DB::transaction(function () use ($request, $id) {
                $servico = Servico::find($id);
                $data = $request->all();
                $data['created_by'] = Auth::user()->id;
                $data['updated_by'] = Auth::user()->id;
                $servico->realizacaos()->updateOrCreate([
                    "servico_id" => $id, "dia_semana" => $data['dia_semana']
                ],$data);
            });
            toastr()->success("Operação de actualização realizada com sucesso", "Successo");
            return redirect()->route('servicos.index');
        } catch (\Exception) {
            toastr()->error("Não foi possível a realização desta operação", "Erro");
            return redirect()->route('servicos.index');
        }
    }

    public function destroy(Request $request, $id)
    {
        try {
            DB::transaction(function () use ($request, $id) {
                $realizacao = Realizacao::find($request->realizacao_id);
                if($realizacao->servico_id != $id)
                    throw new \Exception("Parâmetros inválidos");
                $realizacao->delete();
            });
            toastr()->success("Operação de eliminação realizada com sucesso", "Successo");
            return redirect()->route('servicos.index');
        } catch (\Exception) {
            toastr()->error("Não foi possível a eliminação desta operação", "Erro");
            return redirect()->route('servicos.index');
        }
    }

}
