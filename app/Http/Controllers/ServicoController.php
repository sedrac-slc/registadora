<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Cliente;
use App\Models\Servico;
use App\Utils\ClienteUtil;
use App\Utils\FuncionarioUtil;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ServicoController extends Controller
{
    public function index()
    {
        $panel = "servicos";
        $servicos = Servico::with('realizacaos')->orderBy('id', 'DESC')->paginate();
        return view('pages.servico', compact('servicos', 'panel'));
    }

    public function store(Request $request)
    {
        try {
            if(!FuncionarioUtil::isAuth()){
                toastr()->warning("Permissão negada", "Aviso");
                return redirect()->back();
            }
            DB::transaction(function () use ($request) {
                $data = $request->all();
                $data = $request->all();
                $data['created_by'] = Auth::user()->id;
                $data['updated_by'] = Auth::user()->id;
                Servico::create($data);
            });
            toastr()->success("Operação de criação realizada com sucesso", "Successo");
            return redirect()->back();
        } catch (\Exception) {
            toastr()->error("Não foi possível a realização desta operação", "Erro");
            return redirect()->back();
        }
    }

    public function update(Request $request, $id)
    {
        try {
            if(!FuncionarioUtil::isAuth()){
                toastr()->warning("Permissão negada", "Aviso");
                return redirect()->back();
            }
            $servico = Servico::find($id);
            DB::transaction(function () use ($request, $servico) {
                $data = $request->all();
                $servico->update($data);
            });

            toastr()->success("Operação de actualização realizada com sucesso", "Successo");
            return redirect()->route('servicos.index');
        } catch (\Exception) {
            toastr()->error("Não foi possível a realização desta operação", "Erro");
            return redirect()->route('servicos.index');
        }
    }

    public function destroy($id)
    {
        try {
            if(!FuncionarioUtil::isAuth()){
                toastr()->warning("Permissão negada", "Aviso");
                return redirect()->back();
            }
            $servico = Servico::find($id);
            $servico->delete();
            toastr()->success("Operação de eliminação realizada com sucesso", "Successo");
            return redirect()->route('servicos.index');
        } catch (\Exception) {
            toastr()->error("Não foi possível a realização desta operação", "Erro");
            return redirect()->route('servicos.index');
        }
    }

    public function cliente(Request $request){
        try {
            if(!ClienteUtil::isAuth()){
                toastr()->warning("Permissão negada", "Aviso");
                return redirect()->back();
            }
            DB::transaction(function () use ($request) {
                $data = $request->all();
                switch($data['operation']){
                    case "ADD":
                        $array[$data['servico']] = [
                            'created_by' => Auth::user()->id,
                            'updated_by' => Auth::user()->id,
                            'created_at' => Carbon::now(),
                            'updated_at' => Carbon::now()
                        ];
                        Auth::user()->cliente->servicos()->attach($array);
                        break;
                    case "DEL":
                        $cliente = Auth::user()->cliente;
                        $servico = Servico::find($data['servico']);
                        $servico->clientes()->detach($cliente->id);
                        break;
                    default:
                        throw new \Exception("Parâmetros incorretos");
                }
            });
            toastr()->success("Operação de realizada com sucesso", "Successo");
            return redirect()->route('servicos.index');
        } catch (\Exception) {
            toastr()->error("Não foi possível a realização desta operação", "Erro");
            return redirect()->route('servicos.index');
        }
    }

    public function json_search(Request $request){
        if(!isset($request->search)){
            if(isset($request->cliente)){
                $cliente = Cliente::find($request->cliente);
                return $cliente->servicos()->get();
            }
            return [];
        }
        if(empty($request->search)) return [];
        return Servico::where("nome","like","%{$request->search}%")->get();
    }

}
