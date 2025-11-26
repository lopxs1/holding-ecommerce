<?php

namespace Database\Factories;

use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class ProductFactory extends Factory
{
    public function definition(): array
    {
        return [
            'name'        => Str::title($this->faker->words(3, true)),
            'description' => $this->faker->sentence(12),
            'price'       => $this->faker->randomFloat(2, 10, 5000),
            'image'       => $this->faker->lexify('product_????.jpg'),
            'category_id' => Category::factory(),
        ];
    }
}
