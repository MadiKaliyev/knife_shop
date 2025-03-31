<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Knife Shop</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<!-- Панель с кнопками -->
<div class="container d-flex justify-content-between mt-4">
    <div class="ms-auto">
        @auth
            <!-- Приветствие -->
            <span class="me-3">Привет, {{ Auth::user()->name }}!</span>

            @php
                $isAdmin = Auth::user()->is_admin ?? false;
            @endphp

            <span class="me-3">Роль пользователя: {{ $isAdmin ? 'admin' : 'user' }}</span>

            <!-- Кнопка личного кабинета -->
            <a href="{{ route('profile') }}" class="btn btn-outline-secondary me-2">👤 Личный кабинет</a>

            @if($isAdmin)
                <!-- Админ: создать нож -->
                <a href="{{ route('knives.create') }}" class="btn btn-outline-success me-2">Создать нож</a>
            @else
                <span>Вы не администратор</span>
            @endif

            <!-- Выход -->
            <a href="{{ route('logout') }}" class="btn btn-outline-danger me-2"
               onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                Logout
            </a>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                @csrf
            </form>

            <!-- Корзина -->
            @if (!$isAdmin)
                <a href="{{ route('cart.index') }}" class="btn btn-outline-primary me-2">
                    Корзина 
                    @if ($cartCount > 0)
                        <span class="badge bg-secondary">{{ $cartCount }}</span>
                    @endif
                </a>
            @endif
        @else
            <!-- Гость: вход и регистрация -->
            <a href="{{ route('login') }}" class="btn btn-primary me-2">Login</a>
            @if (Route::has('register'))
                <a href="{{ route('register') }}" class="btn btn-success">Register</a>
            @endif
        @endauth
    </div>
</div>

<!-- Строка поиска -->
<div class="container mt-4">
    <form action="{{ route('welcome') }}" method="GET" class="d-flex" style="max-width: 400px;">
        <input type="text" name="search" class="form-control me-2" placeholder="Поиск ножей"
               value="{{ request()->get('search') }}" style="max-width: 450px;">
        <button class="btn btn-primary" type="submit">Поиск</button>
    </form>
</div>

<!-- Основная часть -->
<div class="container mt-5">
    <h2 class="mb-4">Каталог ножей</h2>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <div class="row">
        @foreach ($knives as $knife)
            <div class="col-md-4 mb-4">
                <div class="card h-100">
                    @if ($knife->image)
                        <img src="{{ asset('storage/' . $knife->image) }}" class="card-img-top" alt="{{ $knife->name }}" style="height: 200px; width: 100%; object-fit: contain;">
                    @endif
                    <div class="card-body">
                        <h5 class="card-title">{{ $knife->name }}</h5>
                        <p class="card-text">{{ $knife->description }}</p>
                    </div>
                    <div class="card-footer text-end">
                        <strong>Цена: ${{ $knife->price }}</strong>

                        @auth
                            @if($isAdmin)
                                <form action="{{ route('knives.destroy', $knife->id) }}" method="POST" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-outline-danger" style="color: red">Удалить нож</button>
                                </form>
                            @else
                                <form action="{{ route('cart.add', $knife->id) }}" method="POST" style="display:inline;">
                                    @csrf
                                    <button type="submit" class="btn btn-outline-primary">Добавить в корзину</button>
                                </form>
                            @endif
                        @endauth
                    </div>
                </div>
            </div>
        @endforeach
    </div>

    <!-- Пагинация -->
    <nav aria-label="Page navigation example">
        <ul class="pagination">
            @if ($knives->onFirstPage())
                <li class="page-item disabled"><span class="page-link">Предыдущая</span></li>
            @else
                <li class="page-item"><a class="page-link" href="{{ $knives->previousPageUrl() }}">Предыдущая</a></li>
            @endif

            @for ($i = 1; $i <= $knives->lastPage(); $i++)
                <li class="page-item {{ $i == $knives->currentPage() ? 'active' : '' }}">
                    <a class="page-link" href="{{ $knives->url($i) }}">{{ $i }}</a>
                </li>
            @endfor

            @if ($knives->hasMorePages())
                <li class="page-item"><a class="page-link" href="{{ $knives->nextPageUrl() }}">Следующая</a></li>
            @else
                <li class="page-item disabled"><span class="page-link">Следующая</span></li>
            @endif
        </ul>
    </nav>
</div>

</body>
</html>
