<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Корзина</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<!-- Панель с кнопками для входа и регистрации или выхода -->
<div class="container d-flex justify-content-between mt-4">
    <div class="ms-auto">
        @auth
            <span class="me-3">Привет, {{ Auth::user()->name }}!</span>
            <a href="{{ route('logout') }}" class="btn btn-outline-danger me-2" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                Logout
            </a>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                @csrf
            </form>
        @else
            <a href="{{ route('login') }}" class="btn btn-primary me-2">Login</a>
        @endauth
    </div>
</div>

<!-- Заголовок корзины -->
<div class="container mt-5">
    <h2 class="mb-4">Ваша корзина</h2>

    <!-- Сообщение об успешном удалении -->
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <div class="row">
        @forelse($cartItems as $cartItem)
            <div class="col-md-4 mb-4">
                <div class="card h-100">
                    @if ($cartItem->knife->image)
                        <img src="{{ asset('storage/' . $cartItem->knife->image) }}" class="card-img-top" alt="{{ $cartItem->knife->name }}" style="height: 200px; object-fit: cover;">
                    @endif
                    <div class="card-body">
                        <h5 class="card-title">{{ $cartItem->knife->name }}</h5>
                        <p class="card-text">{{ $cartItem->knife->description }}</p>
                        <p><strong>Цена: ${{ $cartItem->knife->price }}</strong></p>
                    </div>
                    <div class="card-footer text-end">
                        <!-- Удалить из корзины -->
                        <form action="{{ route('cart.remove', $cartItem->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-outline-danger" style="color: red">Удалить из корзины</button>
                        </form>
                    </div>
                </div>
            </div>
        @empty
            <p>Ваша корзина пуста.</p>
        @endforelse
    </div>

    <div class="text-end">
        <a href="{{ route('welcome') }}" class="btn btn-primary">Вернуться к покупкам</a>
    </div>
</div>

</body>
</html>
