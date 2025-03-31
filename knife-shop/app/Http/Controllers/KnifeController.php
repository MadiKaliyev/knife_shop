<?php

namespace App\Http\Controllers;

use App\Models\Knife;
use Illuminate\Http\Request;
use App\Models\CartItem;

class KnifeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $search = $request->get('search');

        $knives = Knife::when($search, function ($query) use ($search) {
            $search = strtolower($search); // приведение к нижнему регистру

            return $query->whereRaw('LOWER(name) LIKE ?', [$search . '%'])
                        ->orWhereRaw('LOWER(description) LIKE ?', [$search . '%']);
        })->paginate(3);


        // Получаем количество товаров в корзине
        $cartCount = CartItem::where('user_id', auth()->id())->sum('quantity');

        // Возвращаем данные в шаблон
        return view('welcome', compact('knives', 'cartCount'));
    }



    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('knives.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Валидация данных
        $request->validate([
            'name' => 'required',
            'description' => 'nullable',
            'price' => 'required|numeric',
            'image' => 'nullable|image|max:2048', // Проверка, что изображение — это файл изображения
        ]);

        // Создание нового ножа
        $knife = new Knife();
        $knife->name = $request->name;
        $knife->description = $request->description;
        $knife->price = $request->price;

        // Если файл изображения загружен, сохраняем его
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('knives', 'public');
            $knife->image = $imagePath;
        }

        // Сохраняем нож в базе данных
        $knife->save();

        // Перенаправление на страницу с сообщением о успешном добавлении
        return redirect()->route('welcome')->with('success', 'Нож успешно добавлен!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $knife = Knife::findOrFail($id); // Найдем нож по id
        $knife->delete(); // Удаляем нож

        return redirect()->route('welcome')->with('success', 'Нож удален');
    }
}
