<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreProductRequest;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function show(Product $product)
    {
        $product->load('seller');

        return view('products.show', compact('product'));
    }

    public function create()
    {
        return view('products.create');
    }

    public function store(StoreProductRequest $request)
    {
        $product = Product::create([
            ...$request->validated(),
            'seller_id' => auth()->id(),
            'image_url' => 'https://photos.enjoei.com.br/moletom-essential-grey-59171462/1200xN/czM6Ly9waG90b3MuZW5qb2VpLmNvbS5ici9wcm9kdWN0cy8yMDA4MzA5OC9kNWI1NDliYjhiNjc1NjAwZWZkZDNjZGQ5YjkzM2JkMy5qcGc'
        ]);

        return redirect()->route('produto.show', [$product]);
    }

    public function edit(Product $product)
    {
        //
    }

    public function update(Product $product, Request $request)
    {
        //
    }

    public function destroy(Product $product)
    {
        //
    }
}
