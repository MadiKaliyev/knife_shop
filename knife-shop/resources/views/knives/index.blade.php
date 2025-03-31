@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Корзина</h2>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @elseif(session('info'))
        <div class="alert alert-info">
            {{ session('info') }}
        </div>
    @endif

    <div class="row">
        @foreach ($cartItems as $cartItem)
            <div class="col-md-4 mb-4">
                <div class="card">
                    <img src="{{ asset('storage/' . $cartItem->knife->image) }}" class="card-img-top" alt="{{ $cartItem->knife->name }}">
                    <div class="card-body">
                        <h5 class="card-title">{{ $cartItem->knife->name }}</h5>
                        <p class="card-text">{{ $cartItem->knife->description }}</p>
                    </div>
                    <div class="card-footer text-end">
                        <strong>Цена: ${{ $cartItem->knife->price }}</strong>
                        <form action="{{ route('cart.remove', $cartItem) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Удалить из корзины</button>
                        </form>
                    </div>
                </div>
            </div>
        @endforeach
    </div>

</div>

<!-- Каталог ножей -->
<div class="container mt-4">
    <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
        Каталог ножей
    </h2>
    
    <div class="row">
        @foreach ($knives as $knife)
            <div class="col-md-4 mb-4">
                <div class="card h-100">
                    @if($knife->image)
                        <img src="{{ asset('storage/' . $knife->image) }}" class="card-img-top" alt="{{ $knife->name }}">
                    @endif
                    <div class="card-body">
                        <h5 class="card-title">{{ $knife->name }}</h5>
                        <p class="card-text">{{ $knife->description }}</p>
                        <p class="card-text"><strong>Цена:</strong> ${{ $knife->price }}</p>
                        <form action="{{ route('cart.add', $knife->id) }}" method="POST" style="display:inline;">
                            @csrf
                            <button type="submit" class="btn btn-primary">Выбрать</button>
                        </form>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>
@endsection
