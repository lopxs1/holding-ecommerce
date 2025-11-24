<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\Category;

class HoldingFactory extends Factory
{
    public function definition(): array
    {
        return [
            'name'        => $this->faker->words(3, true),
            'address'     => $this->faker->streetAddress,
            'description' => Str::limit($this->faker->sentence(12), 50, ''),
            'owner'       => Str::limit($this->faker->name, 50, ''),
            'regisdate'   => $this->faker->dateTimeBetween('-2 years', 'now'),
            'photo'       => $this->faker->lexify('img_????.jpg'), // <=30 chars
            'category_id' => Category::factory(),
        ];
    }
}
