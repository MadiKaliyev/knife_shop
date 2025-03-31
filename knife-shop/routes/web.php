<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\KnifeController;
use App\Models\Knife;
use App\Models\CartItem;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\ProfileController; // ✅ добавлен контроллер профиля

// Роуты аутентификации
Auth::routes(); 

// Главная страница
Route::get('/', [HomeController::class, 'index'])->name('welcome');

// Роуты для ножей (создание, удаление)
Route::middleware('auth')->group(function () {
    Route::get('/knives/create', [KnifeController::class, 'create'])->name('knives.create');
    Route::post('/knives', [KnifeController::class, 'store'])->name('knives.store');
    Route::delete('/knives/{id}', [KnifeController::class, 'destroy'])->name('knives.destroy');
});

// Админ-панель
Route::middleware('auth')->get('/admin', [AdminController::class, 'dashboard'])->name('admin.dashboard');

// Основная страница каталога ножей
Route::get('/welcome', [KnifeController::class, 'index'])->name('welcome');

// Корзина (только для авторизованных)
Route::middleware(['auth'])->group(function () {
    Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
    Route::post('/cart/{knifeId}', [CartController::class, 'addToCart'])->name('cart.add');
    Route::delete('/cart/{cartItem}', [CartController::class, 'removeFromCart'])->name('cart.remove');
});

// Личный кабинет (только для авторизованных)
Route::middleware('auth')->get('/profile', [ProfileController::class, 'show'])->name('profile');
