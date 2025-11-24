<?php

namespace App\Http\Controllers;

use App\Models\Holding;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckoutController extends Controller
{
    public function index()
    {
        $cartItems = session()->get('cart', []);

        if (empty($cartItems)) {
            return redirect()->route('holdings.index')->with('error', 'Seu carrinho está vazio!');
        }

        // Garantir que só usamos holdings existentes
        $holdings = Holding::whereIn('id', array_keys($cartItems))->get()->keyBy('id');

        // Prepara dados para a view; total permanece 0 porque holdings não têm preço no schema
        $itemsForView = [];
        foreach ($cartItems as $id => $item) {
            if (!isset($holdings[$id])) {
                continue;
            }

            $holding = $holdings[$id];
            $itemsForView[] = [
                'holding_id' => $holding->id,
                'name'       => $holding->name,
                'address'    => $holding->address,
                'owner'      => $holding->owner,
                'photo'      => $holding->photo,
            ];
        }

        $total = 0;

        return view('checkout.index', ['cartItems' => $itemsForView, 'total' => $total]);
    }

    public function store(Request $request)
    {
        $cartItems = session()->get('cart', []);

        if (empty($cartItems)) {
            return redirect()->route('holdings.index')->with('error', 'Seu carrinho está vazio!');
        }

        $order = Order::create([
            'user_id' => Auth::id(),
            'total'   => 0, // holdings não possuem preço; ajuste se adicionar coluna/preço
            'status'  => 'pending',
        ]);

        foreach ($cartItems as $holdingId => $item) {
            OrderItem::create([
                'order_id'   => $order->id,
                'holding_id' => $holdingId,
                'price'      => 0, // sem preço no schema atual
            ]);
        }

        session()->forget('cart');

        return redirect()->route('orders.show', $order)->with('success', 'Pedido realizado com sucesso!');
    }
}
