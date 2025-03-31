<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminController extends Controller
{
    // Метод для отображения админской панели
    public function dashboard()
    {
        return view('admin.dashboard'); // Здесь можно отобразить свою админскую панель
    }
}
