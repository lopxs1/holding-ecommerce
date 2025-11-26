<?php

namespace App\Http\Controllers;

use App\Models\Holding;
use App\Models\Product;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function index()
    {
        $cartItems = session()->get('cart', []);

        return view('cart.index', compact('cartItems'));
    }

    public function add(Holding $holding, Request $request)
    {
        $cart = session()->get('cart', []);
        $key = 'holding_' . $holding->id;

        $cart[$key] = [
            'key'      => $key,
            'type'     => 'holding',
            'id'       => $holding->id,
            'name'     => $holding->name,
            'photo'    => $holding->photo,
            'price'    => $holding->price,
            'quantity' => ($cart[$key]['quantity'] ?? 0) + 1,
        ];

        session()->put('cart', $cart);
        return redirect()->back()->with('success', 'Imóvel adicionado ao carrinho!');
    }

    public function addProduct(Product $product, Request $request)
    {
        $cart = session()->get('cart', []);
        $key = 'product_' . $product->id;

        $cart[$key] = [
            'key'      => $key,
            'type'     => 'product',
            'id'       => $product->id,
            'name'     => $product->name,
            'photo'    => $product->image,
            'price'    => $product->price,
            'quantity' => ($cart[$key]['quantity'] ?? 0) + 1,
        ];

        session()->put('cart', $cart);
        return redirect()->back()->with('success', 'Produto adicionado ao carrinho!');
    }

    public function remove($key)
    {
        $cart = session()->get('cart', []);

        if (isset($cart[$key])) {
            unset($cart[$key]);
            session()->put('cart', $cart);
        }

        return redirect()->back()->with('success', 'Item removido do carrinho!');
    }

    public function update(Request $request, $key)
    {
        $cart = session()->get('cart', []);

        if (isset($cart[$key])) {
            $cart[$key]['quantity'] = max(1, (int) $request->input('quantity', 1));
            session()->put('cart', $cart);
        }

        return redirect()->back()->with('success', 'Carrinho atualizado!');
    }
}
