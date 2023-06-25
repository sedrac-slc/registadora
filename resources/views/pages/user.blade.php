@extends('layouts.page', ['list' => $users])
@php
    use App\Utils\{ClienteUtil, FuncionarioUtil};
    $isCliente = ClienteUtil::isAuth();
    $isFuncionario = FuncionarioUtil::isAuth();
@endphp
@section('page-container')
@endsection
@section('css')
    @parent
    <link rel="stylesheet" href="{{ asset('css/page/home.css') }}" />
    <style>
        tbody td:not(:first-child) {
            padding-top: 1rem;
        }
    </style>
@endsection
@section('buttons')
    <button class="btn btn-outline-primary rounded" id="btn-add-user" data-bs-toggle="modal" data-bs-target="#modalUser"
        url="{{ route($panel . '.store') }}" method="POST">
        <i class="fas fa-user-plus"></i>
        <span>adicionar</span>
    </button>
@endsection
@php $perfil = isset($panel) ? $panel : ""; @endphp
@if ($perfil == 'clientes')
    <input type="hidden" id="url-json" value="{{ route('servico.json') }}">
@endif
@section('thead')
    <th>
        <div><i class="fas fa-image"></i><span>Foto</span></div>
    </th>
    <th>
        <div><i class="fas fa-signature"></i><span>Nome</span></div>
    </th>
    <th>
        <div><i class="fas fa-envelope"></i><span>Email</span></div>
    </th>
    <th>
        <div><i class="fas fa-venus-mars"></i><span>Gênero</span></div>
    </th>
    <th>
        <div><i class="fas fa-phone"></i><span>Telefone</span></div>
    </th>
    <th>
        <div><i class="fas fa-calendar"></i><span>Data nascimnto</span></div>
    </th>
    @if ($perfil == 'funcionarios')
        <th>
            <div><i class="fas fa-list-ol"></i><span>Tipo</span></div>
        </th>
    @elseif ($perfil == 'clientes')
        <th>
            <div><i class="fas fa-list-ol"></i><span>Quantidade(Serviço)</span></div>
        </th>
        <th colspan="2">
            <div><i class="fas fa-cog"></i><span>Serviços</span></div>
        </th>
    @endif
    <th colspan="2">
        <div><i class="fas fa-tools"></i><span>Acções</span></div>
    </th>
@endsection
@section('tbody')
    @foreach ($users as $user)
        <tr style="align-items: center;" >
            <td class="text-center">
                @if ($user->image)
                    <a href="{{ url("storage/{$user->image}") }}">
                        <img src="{{ url("storage/{$user->image}") }}" alt="foto perfil" class="rounded-circle"
                            style="width: 40px; height: 40px;">
                    </a>
                @else
                    <a href="{{ asset('img/avatar.jpg') }}" class="m-2">
                        <img src="{{ asset('img/avatar.jpg') }}" alt="foto perfil" class="rounded-circle"
                            style="width: 35px; height: 35px;">
                    </a>
                    <br />
                    <button class="text-primary bg-none btn-file d-flex gap-1 align-items-center" data-bs-toggle="modal" data-bs-target="#modalFile"
                        url="{{ route('account.photo', $user->id) }}" method="PUT">
                        <i class="fas fa-plus"></i>
                        <span>adicionar</span>
                    </button>
                @endif
            </td>
            <td>{{ $user->name }}</td>
            <td>{{ $user->email }}</td>
            <td data-vd="{{ $user->gender }}">
                {{ $user->gender }}
            </td>
            <td>{{ $user->phone }}</td>
            <td>{{ $user->birthday }}</td>
            @if ($perfil == 'funcionarios')
                <td data-vd={{ $user->funcionario->tipo }}>
                    {{ $user->funcionario->tipo }}
                </td>
            @elseif ($perfil == 'clientes')
                <td>{{ $user->cliente->quantidade_servico }}</td>
                <td>
                    <a href="#" class="text-primary rounded btn-sm btn-servico-add d-flex gap-1 align-items-center" data-bs-toggle="modal"
                        data-bs-target="#modalServicoJoin" url="{{ route('cliente.servico', $user->cliente_id) }}" operation="ADD"
                        method="PUT" name_cliente="{{ $user->name }}">
                        <i class="fas fa-plus"></i>
                        <span>adicionar</span>
                    </a>
                </td>
                <td>
                    <a href="#" class="text-warning rounded btn-sm btn-servico-list d-flex gap-1 align-items-center" data-bs-toggle="modal"
                        data-bs-target="#modalServicoJoin" url="{{ route('cliente.servico', $user->cliente_id) }}" operation="LIST" method="DELETE"
                        cliente="{{ $user->cliente_id }}" name_cliente="{{ $user->name }}">
                        <i class="fas fa-bars"></i>
                        <span>lista</span>
                        <sup>{{ $user->cliente->servicos->count() }}</sup>
                    </a>
                </td>
            @endif
            <td>
                <a href="#" class="text-info rounded btn-sm btn-user-tr d-flex gap-1 align-items-center" data-bs-toggle="modal"
                    data-bs-target="#modalUser" url="{{ route($panel . '.update', $user->id) }}" method="PUT">
                    <i class="fas fa-user-edit"></i>
                    <span>editar</span>
                </a>
            </td>
            <td>
                <a href="#" class="text-danger rounded btn-sm btn-user-del d-flex gap-1 align-items-center" data-bs-toggle="modal"
                    data-bs-target="#modalUser" url="{{ route($panel . '.destroy', $user->id) }}" method="DELETE">
                    <i class="fas fa-user-times"></i>
                    <span>eliminar</span>
                </a>
            </td>
        </tr>
    @endforeach
@endsection
@section('modal')
    @include('components.modal.user', ['type' => $panel])
    @include('components.modal.fileupload')
    @if($perfil == 'clientes')
        @include('components.modal.cliente.service')
    @endif
@endsection
@section('script')
    @parent
    <script src="{{ asset('js/help/clearForm.help.js') }}"></script>
    <script src="{{ asset('js/help/select.help.js') }}"></script>
    <script src="{{ asset('js/fileupload.js') }}"></script>
    @if ($perfil == 'funcionarios')
        <script src="{{ asset('js/page/user/funcionario.js') }}"></script>
    @elseif ($perfil == 'clientes')
        <script src="{{ asset('js/page/user/cliente.js') }}"></script>
        <script src="{{ asset('js/page/cliente/servico.js') }}"></script>
    @else
        <script src="{{ asset('js/page/user.js') }}"></script>
    @endif
@endsection
