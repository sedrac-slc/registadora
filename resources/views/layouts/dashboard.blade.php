@extends('layouts.template')
@php
    use App\Utils\{ClienteUtil, FuncionarioUtil};
    $isCliente = ClienteUtil::isAuth();
    $isFuncionario = FuncionarioUtil::isAuth();
@endphp
@section('body', 'bg-light')
@section('css')
    @parent
    <link rel="stylesheet" href="{{ asset('css/sidebar.css') }}" />
@endsection
@section('content')
    <div class="d-flex" id="wrapper">
        <div class="border-end bg-primary text-white position-relative" id="sidebar-wrapper">
            <div class="sidebar-heading">
                <div class="text-center">
                    <div><span>Registadora</span></div>
                </div>
            </div>
            <div class="list-group list-group-flush">
                <a href="/" class="list-group-item p-3 bg-primary text-white">
                    <i class="fas fa-home"></i>
                    <span>Página incial</span>
                </a>
                <a href="{{ route('home') }}"
                    class="@if (isset($panel) && $panel == 'account') list-group-item-action @else list-group-item @endif p-3 bg-primary text-white">
                    <i class="fas fa-user-circle"></i>
                    <span>Conta</span>
                </a>
                @if ($isFuncionario)
                    <a href="{{ route('funcionarios.index') }}"
                        class="@if (isset($panel) && $panel == 'funcionarios') list-group-item-action @else list-group-item @endif p-3 bg-primary text-white">
                        <i class="fas fa-user-secret"></i>
                        <span>Funcionarios</span>
                    </a>
                    <a href="{{ route('clientes.index') }}"
                        class="@if (isset($panel) && $panel == 'clientes') list-group-item-action @else list-group-item @endif p-3 bg-primary text-white">
                        <i class="fas fa-users"></i>
                        <span>Clientes</span>
                    </a>
                @endif
                <a href="{{ route('servicos.index') }}"
                    class="@if (isset($panel) && $panel == 'servicos') list-group-item-action @else list-group-item @endif p-3 bg-primary text-white">
                    <i class="fa fa-tools" aria-hidden="true"></i>
                    <span>Servicos</span>
                </a>
            </div>
            <div class="div-logout">

            </div>
        </div>

        <div id="page-content-wrapper">

            <nav class="navbar navbar-expand-lg navbar-light bg-white border-bottom">
                <div class="container-fluid">
                        <form class="d-flex gap-1" action="{{ route('logout') }}" method="POST">
                            @csrf
                            <button class="btn btn-warning rounded" id="sidebarToggle">
                                <i class="fas fa-bars"></i>
                                <span>Menu</span>
                            </button>
                            <button type="submit" class="btn btn-danger rounded">
                                <i class="fas fa-power-off"></i>
                                <span>logaut</span>
                            </button>
                        </form>
                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                        data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                        aria-expanded="false" aria-label="Toggle navigation"><span
                            class="navbar-toggler-icon"></span></button>
                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <ul class="navbar-nav ms-auto mt-2 mt-lg-0">

                        </ul>
                    </div>

                </div>
            </nav>
            <div class="container-fluid">
                @yield('painel')
            </div>
        </div>
    </div>
@endsection
@section('script')
    @parent

@endsection
