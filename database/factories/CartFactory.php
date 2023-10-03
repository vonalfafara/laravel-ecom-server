<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Product;
use App\Models\User;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Cart>
 */
class CartFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            "product_id" => fake()->randomElement(Product::pluck("id")),
            "user_id" => fake()->randomElement(User::pluck("id")),
            "quantity" => fake()->numberBetween(0, 20)
        ];
    }
}
