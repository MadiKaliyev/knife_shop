@extends('layouts.app')

@section('content')
<a href="{{ route('home') }}">Главная страница</a>

<div class="container mt-3 text-end">

    @if (Route::has('login'))

        @auth

            <span class="me-3">Привет, {{ Auth::user()->name }}!</span>

            <p>Роль пользователя: {{ Auth::user()->role }}</p>

            @if (Auth::user()->role === 'admin')

                <!-- Кнопка для добавления ножа для админа -->
                <a href="{{ route('knives.create') }}" class="btn btn-success btn-sm me-2">Добавить нож</a>

            @endif

            <!-- Остальная часть кнопок -->

        @endauth

    @endif

</div>

<div class="d-flex justify-content-center align-items-center vh-100">

    <div class="text-center">

        <h1 class="display-5 fw-bold">Добро пожаловать в Knife Shop</h1>

        <p class="lead text-muted">Интернет-магазин ножей для Steam</p>

    </div>

</div>

<div class="row justify-content-center">

    <div class="col-md-8">

        <div class="card">

            <div class="card-header">{{ __('Dashboard') }}</div>

            <div class="card-body">

                @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                @endif

            </div>

        </div>

    </div>

</div>

@endsection

