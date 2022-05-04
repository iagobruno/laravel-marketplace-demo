<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class OrdersController extends Controller
{
    public function __invoke(Request $request)
    {
        $products = auth()->user()->orders;

        return view('user-orders', compact('products'));
    }
}
