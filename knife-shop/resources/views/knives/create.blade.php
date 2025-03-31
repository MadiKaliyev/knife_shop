@extends('layouts.app')

@section('content')
<div class="container mt-3">
    <h1>Добавить нож</h1>

    <!-- Форма для добавления ножа -->
    <form action="{{ route('knives.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <!-- Поле для ввода названия ножа -->
        <div class="mb-3">
            <label for="name" class="form-label">Название ножа</label>
            <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" id="name" value="{{ old('name') }}" required>
            @error('name')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <!-- Поле для ввода описания ножа -->
        <div class="mb-3">
            <label for="description" class="form-label">Описание ножа</label>
            <textarea name="description" class="form-control @error('description') is-invalid @enderror" id="description" rows="4" required>{{ old('description') }}</textarea>
            @error('description')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <!-- Поле для ввода цены ножа -->
        <div class="mb-3">
            <label for="price" class="form-label">Цена</label>
            <input type="number" name="price" class="form-control @error('price') is-invalid @enderror" id="price" value="{{ old('price') }}" required>
            @error('price')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <!-- Поле для загрузки изображения -->
        <div class="mb-3">
            <label for="image" class="form-label">Изображение ножа</label>
            <input type="file" name="image" class="form-control @error('image') is-invalid @enderror" id="image" accept="image/*">
            @error('image')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <!-- Кнопка отправки формы -->
        <button type="submit" class="btn btn-success">Добавить нож</button>
    </form>
</div>
@endsection
