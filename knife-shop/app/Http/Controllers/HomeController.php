<?php

namespace App\Http\Controllers;

use App\Models\Knife;
use App\Models\CartItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Показать главную страницу с ножами.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        // Получаем количество товаров в корзине для текущего пользователя
        $cartCount = CartItem::where('user_id', auth()->id())->count();

        // Получаем ножи с пагинацией для отображения на главной странице
        $knives = Knife::paginate(3); // 9 ножей на странице

        // Передаем данные в представление
        return view('welcome', compact('knives', 'cartCount'));
    }
}
