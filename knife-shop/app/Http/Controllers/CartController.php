<?php

namespace App\Http\Controllers;

use App\Models\CartItem;  // Используем CartItem для корзины
use App\Models\Knife;     // Используем Knife для ножей
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    // Отображение корзины
    public function index()
    {
        // Получаем все ножи, добавленные в корзину текущего пользователя
        $cartItems = CartItem::where('user_id', auth()->id())->with('knife')->get();

        return view('cart.index', compact('cartItems'));
    }

    // Добавление ножа в корзину
    public function addToCart($knifeId)
    {
        $knife = Knife::findOrFail($knifeId);  // Получаем нож по ID

        // Проверяем, есть ли уже этот нож в корзине
        $cartItem = CartItem::where('user_id', auth()->id())
                            ->where('knife_id', $knife->id)
                            ->first();

        if ($cartItem) {
            // Если нож уже есть в корзине, увеличиваем количество
            $cartItem->quantity++;
            $cartItem->save();
        } else {
            // Если ножа нет в корзине, добавляем новый
            CartItem::create([
                'user_id' => auth()->id(),
                'knife_id' => $knife->id,
                'quantity' => 1, // Изначально добавляем 1 нож
            ]);
        }

        return redirect()->route('cart.index')->with('success', 'Нож добавлен в корзину!');
    }

    // Удаление ножа из корзины
    public function removeFromCart(CartItem $cartItem)
    {
        $cartItem->delete(); // Удаляем из корзины

        return redirect()->route('cart.index')->with('success', 'Нож удален из корзины');
    }
}
