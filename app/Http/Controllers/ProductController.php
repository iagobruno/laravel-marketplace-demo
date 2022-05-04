<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreProductRequest;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class ProductController extends Controller
{
    public function show(Product $product)
    {
        $product->load('seller');

        return view('products.show', compact('product'));
    }

    public function create()
    {
        Gate::authorize('create', Product::class);

        return view('products.edit', [
            'editMode' => false
        ]);
    }

    public function store(StoreProductRequest $request)
    {
        Gate::authorize('create', Product::class);

        $data = $request->validated();
        $product = Product::create([
            ...$data,
            'price' => $data['price'] * 100,
            'seller_id' => auth()->id(),
            'image_url' => 'https://photos.enjoei.com.br/moletom-essential-grey-59171462/1200xN/czM6Ly9waG90b3MuZW5qb2VpLmNvbS5ici9wcm9kdWN0cy8yMDA4MzA5OC9kNWI1NDliYjhiNjc1NjAwZWZkZDNjZGQ5YjkzM2JkMy5qcGc',
        ]);

        return redirect()->route('produto.show', [$product])
            ->with('success', 'Produto criado!');
    }

    public function edit(Product $product, Request $request)
    {
        Gate::authorize('update', $product);

        return view('products.edit', [
            'product' => $product,
            'editMode' => true
        ]);
    }

    public function update(Product $product, StoreProductRequest $request)
    {
        Gate::authorize('update', $product);

        $data = $request->validated();
        $product->update([
            ...$data,
            'price' => $data['price'] * 100,
        ]);

        return redirect()->route('produto.show', $product)
            ->with('success', 'Informações do produto foram atualizadas!');
    }

    public function destroy(Product $product)
    {
        Gate::authorize('delete', $product);

        $product->delete();

        return redirect()->route('home')
            ->with('success', 'Produto deletado!');
    }
}
