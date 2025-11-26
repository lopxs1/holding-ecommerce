<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;
use App\Models\Holding;
use App\Models\Product;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\User;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $admin = User::factory()->create([
            'name' => 'Admin User',
            'email' => 'admin@example.com',
            'is_admin' => true,
            'password' => bcrypt('admin'),
        ]);

        $customer = User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
            'is_admin' => false,
            'password' => bcrypt('test'),
        ]);

        $categories = Category::factory(5)->create();

        Holding::factory(10)
            ->make()
            ->each(function ($holding) use ($categories) {
                $holding->category_id = $categories->random()->id;
                $holding->save();
            });

        $products = Product::factory(15)
            ->make()
            ->each(function ($product) use ($categories) {
                $product->category_id = $categories->random()->id;
                $product->save();
            });

        $order = Order::create([
            'user_id' => $customer->id,
            'total'   => 0,
            'status'  => 'Pendente',
        ]);

        $total = 0;
        $products->random(3)->each(function ($product) use (&$total, $order) {
            $quantity = rand(1, 3);
            $lineTotal = $product->price * $quantity;

            OrderItem::create([
                'order_id'   => $order->id,
                'product_id' => $product->id,
                'quantity'   => $quantity,
                'unit_price' => $product->price,
            ]);

            $total += $lineTotal;
        });

        $order->update(['total' => $total]);
    }
}
