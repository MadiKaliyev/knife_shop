<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CartItem extends Model
{
    use HasFactory;

    // Описание заполняемых полей
    protected $fillable = [
        'user_id',
        'knife_id',
        'quantity', // добавляем поле quantity для количества товаров в корзине
    ];

    // Связь с ножом
    public function knife()
    {
        return $this->belongsTo(Knife::class);
    }

    // Связь с пользователем
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
