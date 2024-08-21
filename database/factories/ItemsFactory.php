<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Items>
 */
class ItemsFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => fake()->name(),
            'price' => fake()->numberBetween(0, 1000),
            'stock' => fake()->numberBetween(0, 1000),
            'description' => fake()->text(100),
            'image' => fake()->imageUrl(),
            'status' => fake()->randomElement(['available', 'unavailable']),
            'category_id' => \App\Models\Category::inRandomOrder()->first()->id,
            'users_id' => \App\Models\User::inRandomOrder()->first()->id,
        ];
    }
}
