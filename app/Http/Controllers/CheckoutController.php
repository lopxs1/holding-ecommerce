<?php

namespace App\Http\Controllers;

use App\Models\Holding;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
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

        $holdings = Holding::whereIn('id', $this->extractIdsByType($cartItems, 'holding'))->get()->keyBy('id');
        $products = Product::whereIn('id', $this->extractIdsByType($cartItems, 'product'))->get()->keyBy('id');

        $itemsForView = [];
        foreach ($cartItems as $item) {
            $quantity = $item['quantity'] ?? 1;

            if (($item['type'] ?? null) === 'holding' && isset($holdings[$item['id']])) {
                $holding = $holdings[$item['id']];
                $itemsForView[] = [
                    'key'      => $item['key'],
                    'type'     => 'holding',
                    'name'     => $holding->name,
                    'address'  => $holding->address,
                    'owner'    => $holding->owner,
                    'photo'    => $holding->photo,
                    'price'    => $holding->price,
                    'quantity' => $quantity,
                    'subtotal' => $holding->price * $quantity,
                ];
            }

            if (($item['type'] ?? null) === 'product' && isset($products[$item['id']])) {
                $product = $products[$item['id']];
                $itemsForView[] = [
                    'key'      => $item['key'],
                    'type'     => 'product',
                    'name'     => $product->name,
                    'photo'    => $product->image,
                    'price'    => $product->price,
                    'quantity' => $quantity,
                    'subtotal' => $product->price * $quantity,
                ];
            }
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
        $holdings = Holding::whereIn('id', $this->extractIdsByType($cartItems, 'holding'))->get()->keyBy('id');
        $products = Product::whereIn('id', $this->extractIdsByType($cartItems, 'product'))->get()->keyBy('id');

        foreach ($cartItems as $item) {
            $quantity = max(1, (int)($item['quantity'] ?? 1));

            if (($item['type'] ?? null) === 'holding' && isset($holdings[$item['id']])) {
                $holding = $holdings[$item['id']];

                OrderItem::create([
                    'order_id'   => $order->id,
                    'holding_id' => $holding->id,
                    'quantity'   => $quantity,
                    'unit_price' => $holding->price,
                ]);

                $total += $holding->price * $quantity;
            }

            if (($item['type'] ?? null) === 'product' && isset($products[$item['id']])) {
                $product = $products[$item['id']];

                OrderItem::create([
                    'order_id'   => $order->id,
                    'product_id' => $product->id,
                    'quantity'   => $quantity,
                    'unit_price' => $product->price,
                ]);

                $total += $product->price * $quantity;
            }
        }

        $order->update(['total' => $total]);
        session()->forget('cart');

        return redirect()->route('orders.show', $order)->with('success', 'Pedido realizado com sucesso!');
    }

    private function extractIdsByType(array $cartItems, string $type): array
    {
        return collect($cartItems)
            ->filter(fn ($item) => ($item['type'] ?? null) === $type)
            ->pluck('id')
            ->all();
    }
}
