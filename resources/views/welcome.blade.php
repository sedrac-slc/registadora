@extends('layouts.template')
@section('content')
    <nav class="navbar navbar-expand-sm navbar-dark bg-primary" aria-label="Third navbar example">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">Registadora</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarsExample03"
                aria-controls="navbarsExample03" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarsExample03">
                <ul class="navbar-nav me-auto mb-2 mb-sm-0">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="#">Página inicial</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Informações</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Serviços</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <header class="bg-primary">
        <div class="container container-lg">
            <div class="row text-center">
                <div class="col-md-7">
                    <div class="mb-2 mt-2">
                        <div class="h2 mb-2 text-white">Bem vindo</div>
                        <hr />
                        <div class="h5 text-white">Neste site, poderas fazer agendamentos dos nossos serviços a qualquer
                            momento sem se preocupar
                            com filas, e quando os documentos estivem prontos será motificado para pegar.</div>
                    </div>
                    @if (Route::has('login'))
                        <div class="mt-2 m-auto">
                            @auth
                                <a href="{{ url('/home') }}" class="btn btn-sm btn-info">Panel</a>
                            @else
                                <a href="{{ route('login') }}" class="btn btn-sm btn-info">Login</a>
                                @if (Route::has('register'))
                                    <a href="{{ route('register') }}" class="btn btn-sm btn-warning">Registro</a>
                                @endif
                            @endauth
                        </div>
                    @endif
                </div>
                <div class="col-md-5">
                    <img src="{{ asset('img/bg-lateral.png') }}" alt="" class="bg-lateral" width="200"
                        height="200">
                </div>
            </div>
        </div>
    </header>
    <div class="container">
        <div class="mt-4">
            <i class="fas fa-cog"></i>
            <span>Serviços</span>
        </div>
        <hr />
        <div class="row">
            <div class="col">
                <div class="card">
                    <div class="card-header">
                        Agendamento
                    </div>
                    <div class="card-body">
                        <h5 class="card-title">Agendar emissão documento</h5>
                        <p class="card-text">O nosso principal serviço é oferece possibilidade das pessoas fazerem agendamento da emissão de documentos apartir deste website e quando os documentor forem emitidos os clientes serão notificados, de modo a evitar filas nos balcões de atendimento.</p>
                        <a href="#" class="btn btn-primary">Vamos começar</a>
                    </div>
                    <div class="card-footer text-muted">
                        2 days ago
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
