<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class HomeController extends Controller
{

    public function index()
    {
        $title = 'Home';
        $products = Product::query()->where('status', 1)->get();
        return view('home', compact('title', 'products'));
    }

    public function invest()
    {
        $title = 'Đầu tư';
        $products = Product::all();
        return view('invest', compact('title', 'products'));
    }

    public function about()
    {
        $title = 'Về chúng tôi';
        return view('about', compact('title'));
    }

    public function desposit()
    {
        $title = 'Nạp tiền';
        return view('desposit', compact('title'));
    }

    public function withdraw()
    {
        $title = 'Rút tiền';
        return view('withdraw', compact('title'));
    }
}
