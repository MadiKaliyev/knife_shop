<!-- resources/views/cart/index.blade.php -->
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Корзина</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

    <div class="container mt-4">
        <h2 class="mb-4">Ваша корзина</h2>

        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        @forelse ($cartItems as $cartItem)
            <div class="card mb-3">
                <div class="card-body">
                    <h5 class="card-title">{{ $cartItem->knife->name }}</h5>
                    <p class="card-text">{{ $cartItem->knife->description }}</p>
                    <p class="card-text"><strong>Цена:</strong> ${{ $cartItem->knife->price }}</p>
                    <p class="card-text"><strong>Количество:</strong> {{ $cartItem->quantity }}</p>
                    <form action="{{ route('cart.remove', $cartItem) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-outline-danger">Удалить</button>
                    </form>
                </div>
            </div>
        @empty
            <p>Ваша корзина пуста.</p>
        @endforelse
    </div>

</body>
</html>
