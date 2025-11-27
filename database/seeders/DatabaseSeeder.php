<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;
use App\Models\Holding;
use App\Models\Product;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\User;
use Illuminate\Support\Carbon;
use Illuminate\Support\Str;

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

        $categories = collect([
            ['name' => 'Residencial', 'description' => 'Casas e apartamentos'],
            ['name' => 'Comercial', 'description' => 'Lojas e salas comerciais'],
            ['name' => 'Tecnologia', 'description' => 'Eletrônicos e acessórios'],
            ['name' => 'Móveis', 'description' => 'Cadeiras, mesas e decoração'],
            ['name' => 'Mercado', 'description' => 'Itens de consumo e mantimentos'],
        ])->map(fn ($data) => Category::create([
            'name'        => $data['name'],
            'description' => $data['description'],
            'slug'        => Str::slug($data['name']),
        ]));

        $holdingsData = [
            [
                'name'        => 'Apartamento Bela Vista',
                'address'     => 'Rua das Flores, 120 - São Paulo, SP',
                'description' => '2 dormitórios, 1 vaga, 65m², reformado e pronto para morar.',
                'owner'       => 'Construtora Alpha',
                'price'       => 520000,
                'photo'       => '1.png',
            ],
            [
                'name'        => 'Casa Jardim das Acácias',
                'address'     => 'Alameda Ipê Amarelo, 450 - Campinas, SP',
                'description' => 'Sobrado 3 suítes, área gourmet e piscina aquecida.',
                'owner'       => 'Maria Ferreira',
                'price'       => 1190000,
                'photo'       => '2.jpg',
            ],
            [
                'name'        => 'Sala Comercial Centro Empresarial',
                'address'     => 'Av. Paulista, 2000 - São Paulo, SP',
                'description' => '42m², 1 vaga, pronta para uso, próximo ao metrô.',
                'owner'       => 'Faria Lima Offices',
                'price'       => 430000,
                'photo'       => '3.jpg',
            ],
            [
                'name'        => 'Terreno Vista Verde',
                'address'     => 'Estrada do Sol, km 12 - Sorocaba, SP',
                'description' => 'Lote 360m² em condomínio fechado com lazer completo.',
                'owner'       => 'Incorp ABC',
                'price'       => 310000,
                'photo'       => '4.png',
            ],
            [
                'name'        => 'Studio Smart Home',
                'address'     => 'Rua Oscar Freire, 815 - São Paulo, SP',
                'description' => 'Studio 32m² mobiliado, automação e varanda.',
                'owner'       => 'Invest SA',
                'price'       => 389000,
                'photo'       => '5.jpg',
            ],
        ];

        $holdings = collect($holdingsData)->map(function ($data) use ($categories) {
            return Holding::create([
                'name'        => $data['name'],
                'address'     => $data['address'],
                'description' => $data['description'],
                'owner'       => $data['owner'],
                'price'       => $data['price'],
                'regisdate'   => Carbon::now()->subDays(rand(10, 120)),
                'photo'       => $data['photo'], // imagem será adicionada depois
                'category_id' => $categories->where('name', str_contains($data['name'], 'Comercial') ? 'Comercial' : 'Residencial')->first()->id,
            ]);
        });

        $productsData = [
            [
                'name'        => 'Notebook Dell Inspiron 15',
                'description' => 'Intel i5 12ª geração, 8GB RAM, SSD 512GB, Windows 11.',
                'price'       => 4599.90,
                'category'    => 'Tecnologia',
                'photo'       => '6.jpg',
            ],
            [
                'name'        => 'Cadeira Gamer ErgoPro',
                'description' => 'Estrutura reforçada, apoio lombar e reclínio 180°.',
                'price'       => 899.00,
                'category'    => 'Móveis',
                'photo'       => '7.jpg',
            ],
            [
                'name'        => 'Geladeira Frost Free 400L',
                'description' => 'Inox, controle eletrônico, modo turbo para festas.',
                'price'       => 3299.00,
                'category'    => 'Mercado',
                'photo'       => '8.jpg',
            ],
            [
                'name'        => 'Smartphone Galaxy S23',
                'description' => 'Tela 6.1" AMOLED, 128GB, câmera tripla com estabilização.',
                'price'       => 3899.00,
                'category'    => 'Tecnologia',
                'photo'       => '9.jpg',
            ],
            [
                'name'        => 'Mesa de Jantar 6 Lugares',
                'description' => 'Tampo de vidro temperado e base de madeira maciça.',
                'price'       => 1490.00,
                'category'    => 'Móveis',
                'photo'       => '10.jpg',
            ],
            [
                'name'        => 'Kit Café Especial',
                'description' => '3 pacotes de 250g de grãos selecionados torrados na semana.',
                'price'       => 129.90,
                'category'    => 'Mercado',
                'photo'       => '11.jpg',
            ],
            [
                'name'        => 'Monitor 27" IPS 144Hz',
                'description' => 'Quad HD, 1ms, compatível com G-Sync/FreeSync.',
                'price'       => 1799.00,
                'category'    => 'Tecnologia',
                'photo'       => '12.jpg',
            ],
            [
                'name'        => 'Sofá Retrátil 3 Lugares',
                'description' => 'Tecido suede, 2,30m, assentos com espuma D33.',
                'price'       => 2490.00,
                'category'    => 'Móveis',
                'photo'       => '13.jpg',
            ],
        ];

        $products = collect($productsData)->map(function ($data) use ($categories) {
            return Product::create([
                'name'        => $data['name'],
                'description' => $data['description'],
                'price'       => $data['price'],
                'image'       => $data['photo'], // imagem será adicionada depois
                'category_id' => $categories->where('name', $data['category'])->first()->id,
            ]);
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
