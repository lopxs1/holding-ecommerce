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

        // Apenas holdings existentes
        $holdings = Holding::whereIn('id', array_keys($cartItems))->get()->keyBy('id');

        // Dados para a view com preço
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
                'price'      => $holding->price,
                'quantity'   => $item['quantity'] ?? 1,
            ];
        }

        $total = collect($itemsForView)->sum(function ($item) {
            return ($item['quantity'] ?? 1) * $item['price'];
        });

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
            'total'   => 0,
            'status'  => 'pending',
        ]);

        $total = 0;
        $holdings = Holding::whereIn('id', array_keys($cartItems))->get()->keyBy('id');

        foreach ($cartItems as $holdingId => $item) {
            if (!isset($holdings[$holdingId])) {
                continue;
            }

            $holding = $holdings[$holdingId];
            $quantity = max(1, (int)($item['quantity'] ?? 1));

            OrderItem::create([
                'order_id'   => $order->id,
                'holding_id' => $holdingId,
                'quantity'   => $quantity,
                'unit_price' => $holding->price,
            ]);

            $total += $holding->price * $quantity;
        }

        $order->update(['total' => $total]);
        session()->forget('cart');

        return redirect()->route('orders.show', $order)->with('success', 'Pedido realizado com sucesso!');
    }
}
