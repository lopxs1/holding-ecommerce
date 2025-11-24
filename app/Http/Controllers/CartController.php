<?php

namespace App\Http\Controllers;

use App\Models\Holding;
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

        if (isset($cart[$holding->id])) {
            $cart[$holding->id]['quantity']++;
        } else {
            $cart[$holding->id] = [
                'holding_id' => $holding->id,
                'name'       => $holding->name,
                'photo'      => $holding->photo,
                'quantity'   => 1,
            ];
        }

        session()->put('cart', $cart);
        return redirect()->back()->with('success', 'Imóvel adicionado ao carrinho!');
    }

    public function remove($holdingId)
    {
        $cart = session()->get('cart', []);

        if (isset($cart[$holdingId])) {
            unset($cart[$holdingId]);
            session()->put('cart', $cart);
        }

        return redirect()->back()->with('success', 'Imóvel removido do carrinho!');
    }

    public function update(Request $request, $holdingId)
    {
        $cart = session()->get('cart', []);

        if (isset($cart[$holdingId])) {
            $cart[$holdingId]['quantity'] = max(1, (int) $request->input('quantity', 1));
            session()->put('cart', $cart);
        }

        return redirect()->back()->with('success', 'Carrinho atualizado!');
    }
}