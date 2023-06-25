@extends('layouts.page', ['list' => $servicos])
@php
    use App\Utils\{ClienteUtil, FuncionarioUtil};


    $arrayIdServiceOfCliente = [];

    $isCliente = ClienteUtil::isAuth();
    $isFuncionario = FuncionarioUtil::isAuth();

    if($isCliente){
        $arrayIdServiceOfCliente = Auth::user()->cliente->servicos->map(function($q){
            return $q->id;
        })->all();
    }
@endphp
@section('page-container')
@endsection
@section('css')
    @parent
    <link rel="stylesheet" href="{{ asset('css/page/home.css') }}" />
@endsection
@if ($isFuncionario)
    @section('buttons')
        <button class="btn btn-outline-primary rounded" id="btn-add-user" data-bs-toggle="modal" data-bs-target="#modalServico"
            url="{{ route($panel . '.store') }}" method="POST">
            <i class="fas fa-user-plus"></i>
            <span>adicionar</span>
        </button>
    @endsection
@endif
@section('thead')
    <th>
        <div><i class="fas fa-signature"></i><span>Nome</span></div>
    </th>
    <th>
        <div><i class="fas fa-money-bill"></i><span>Preco</span></div>
    </th>
    <th>
        <div><i class="fas fa-comment"></i><span>Descricao</span></div>
    </th>
    <th @if ($isFuncionario) colspan="2" @endif>
        <div><i class="fas fa-calendar"></i><span>Realização</span></div>
    </th>
    @if ($isCliente)
        <th>
            <div><i class="fas fa-user-plus"></i><span>Registar</span></div>
        </th>
    @endif
    @if ($isFuncionario)
        <th colspan="2">
            <div><i class="fas fa-tools"></i><span>Acções</span></div>
        </th>
    @endif
@endsection
@section('tbody')
    @foreach ($servicos as $servico)
        @php $isPresent = in_array($servico->id,$arrayIdServiceOfCliente); @endphp
        <tr>
            <td>{{ $servico->nome }}</td>
            <td>{{ $servico->preco }}</td>
            <td>{{ $servico->descricao }}</td>
            @if ($isFuncionario)
                <td>
                    <a href="#"
                        class="text-success rounded btn-sm btns-realizacao-add d-flex gap-1 align-items-center"
                        data-bs-toggle="modal" data-bs-target="#modalRealizacao" code="" title="Adicionar\Relização"
                        url="{{ route('realizacoes.update', $servico->id) }}" method="PUT">
                        <i class="fas fa-plus"></i>
                        <span>adicionar</span>
                    </a>
                </td>
            @endif
            <td>
                <a href="#" class="text-info rounded btn-sm btns-realizacao-list d-flex gap-1 align-items-center"
                    data-bs-toggle="modal" data-bs-target="#modalRealizacao" code="" title="Listar\Realização"
                    url-json="{{ route('realizacoes.index') }}?servico={{ $servico->id }}"
                    url="{{ route('realizacoes.destroy', $servico->id) }}" method="DELETE"
                    @if ($isFuncionario) viewAction = "true"
                    @else
                        viewAction = "false" @endif>
                    <i class="fas fa-bars"></i>
                    <span>listar</span>
                    <sup>{{ $servico->realizacaos->count() }}</sup>
                </a>
            </td>
            @if ($isCliente)
                <td>
                    <a href="#"
                        class="@if($isPresent) text-danger btns-registro-del @else text-success btns-registro-add @endif rounded btn-sm d-flex gap-1 align-items-center"
                        data-bs-toggle="modal" data-bs-target="#modalRegistar"
                        url="{{ route('servico.cliente') }}?servico={{$servico->id}}"
                        @if($isPresent) operation = "DEL" title="Anulação"  @else operation = "ADD" title="Solicitação" @endif>
                        <i class="fas @if($isPresent) fa-times @else fa-plus @endif "></i>
                        <span>@if($isPresent) eliminar @else adicionar @endif </span>
                    </a>
                </td>
            @endif
            @if ($isFuncionario)
                <td>
                    <a href="#" class="text-warning rounded btn-sm btn-user-tr d-flex gap-1 align-items-center"
                        data-bs-toggle="modal" data-bs-target="#modalServico"
                        url="{{ route($panel . '.update', $servico->id) }}" method="PUT">
                        <i class="fas fa-user-edit"></i>
                        <span>editar</span>
                    </a>
                </td>
                <td>
                    <a href="#" class="text-danger rounded btn-sm btn-user-del d-flex gap-1 align-items-center"
                        data-bs-toggle="modal" data-bs-target="#modalServico"
                        url="{{ route($panel . '.destroy', $servico->id) }}" method="DELETE">
                        <i class="fas fa-user-times"></i>
                        <span>eliminar</span>
                    </a>
                </td>
            @endif
        </tr>
    @endforeach
@endsection
@section('modal')
    @if ($isFuncionario)
        @include('components.modal.servico')
    @endif
    @if ($isCliente)
        @include('components.modal.servico.cliente')
    @endif
    @include('components.modal.realizacao')
@endsection
@section('script')
    @parent
    @if ($isFuncionario)
        <script src="{{ asset('js/help/clearForm.help.js') }}"></script>
        <script src="{{ asset('js/help/textarea.help.js') }}"></script>
        <script src="{{ asset('js/page/servico.js') }}"></script>
    @endif
    @if ($isCliente)
        <script src="{{ asset('js/page/servico/cliente.js') }}"></script>
    @endif
    <script src="{{ asset('js/page/realizacao.js') }}"></script>
@endsection
