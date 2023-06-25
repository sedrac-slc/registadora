@extends('layouts.template')
@section('body', 'bg-light')
@section('css')
    <link rel="stylesheet" href="{{ asset('css/login-register.css') }}" />
@endsection
@section('content')
    <form method="POST" action="{{ route('register') }}" class="w-75 bg-white register pt-4">
        @csrf
        <h4>
            <a href="/" class="btn btn-primary rounded">
                voltar
            </a>
            <span class="ml-2">Faça o Registro</span>
        </h4>
        <hr/>
        @include('components.message')
        @include('components.errors')

        @include('components.import.user')

        <div class="mt-4">
            <button class="btn btn-outline-success" type="submit">
                <i class="fas fa-file-alt"></i>
                <span>cadastramento</span>
            </button>
        </div>
        <div class="flex items-center justify-end mt-2 mb-2">
            <a class="text-primary t-d-n" href="{{ route('login') }}">
                <i class="fas fa-user"></i>
                <span class="ml-1">Já tenho uma conta</span>
            </a>
        </div>

    </form>
@endsection
