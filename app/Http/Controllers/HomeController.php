<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function __invoke()
    {
        $products = Product::available()->latest()->get();

        return view('home', compact(['products']));
    }
}
