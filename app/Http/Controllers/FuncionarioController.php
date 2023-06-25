<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Funcionario;
use App\Models\User;
use App\Utils\FileUploadUtil;
use App\Utils\FuncionarioUtil;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class FuncionarioController extends Controller
{
    public function index()
    {
        if(!FuncionarioUtil::isAuth()){
            toastr()->warning("Permissão negada", "Aviso");
            return redirect()->back();
        }
        $panel = "funcionarios";
        $users = User::join('funcionarios', 'user_id', 'users.id')->orderBy('users.id', 'DESC')
                ->select('users.*','funcionarios.id as funcionario_id')
                ->paginate();
        return view('pages.user', compact('users', 'panel'));
    }

    public function store(Request $request)
    {
        try {
            if(!FuncionarioUtil::isAuth()){
                toastr()->warning("Permissão negada", "Aviso");
                return redirect()->back();
            }
            if($request->password_confirmation != $request->password){
                toastr()->warning("Senhas são diferentes", "Aviso");
                return redirect()->route('funcionarios.index');
            }
            DB::transaction(function () use ($request) {
                $data = $request->all();
                $data['created_by'] = Auth::user()->id;
                $data['updated_by'] = Auth::user()->id;
                $data['password'] = Hash::make($data['password']);
                FileUploadUtil::uploadUserPhoto($request,null,$data);
                $user = User::create($data);
                $data['user_id'] = $user->id;
                Funcionario::create($data);
            });
            toastr()->success("Operação de criação realizada com sucesso", "Successo");
            return redirect()->route('funcionarios.index');
        } catch (\Exception) {
            toastr()->error("Não foi possível a realização desta operação", "Erro");
            return redirect()->route('funcionarios.index');
        }
    }

    public function update(Request $request, $id)
    {
        try {
            if(!FuncionarioUtil::isAuth()){
                toastr()->warning("Permissão negada", "Aviso");
                return redirect()->back();
            }
            DB::transaction(function () use ($request, $id) {
                $data = $request->all();
                $data['updated_by'] = Auth::user()->id;
                $user = User::find($id);
                FileUploadUtil::uploadUserPhoto($request,$user,$data);
                $user->update($data);
                $user->funcionario()->update([
                    "tipo" => $request->tipo,
                    "updated_by" => Auth::user()->id,
                    "updated_at" => Carbon::now()
                ]);
            });
            toastr()->success("Operação de actualização realizada com sucesso", "Successo");
            return redirect()->route('funcionarios.index');
        } catch (\Exception $e) {
            dd($e);
            toastr()->error("Não foi possível a realização desta operação", "Erro");
            return redirect()->route('funcionarios.index');
        }
    }

    public function destroy($id)
    {
        try {
            if(!FuncionarioUtil::isAuth()){
                toastr()->warning("Permissão negada", "Aviso");
                return redirect()->back();
            }
            DB::transaction(function () use ($id) {
                $user = User::find($id);
                $user->delete();
            });
            toastr()->success("Operação de eliminação realizada com sucesso", "Successo");
            return redirect()->route('funcionarios.index');
        } catch (\Exception) {
            toastr()->error("Não foi possível a realização desta operação", "Erro");
            return redirect()->route('funcionarios.index');
        }
    }

}
