@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Личный кабинет</h1>

    <div class="card">
        <div class="card-body">
            <p><strong>Имя:</strong> {{ $user->name }}</p>
            <p><strong>Email:</strong> {{ $user->email }}</p>
            <p><strong>Роль:</strong> {{ $user->is_admin ? 'Администратор' : 'Пользователь' }}</p>
            <p><strong>Дата регистрации:</strong> {{ $user->created_at->format('d.m.Y H:i') }}</p>
        </div>
    </div>
</div>
@endsection
