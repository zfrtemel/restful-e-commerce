<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'product_name' => fake()->name(),
            'product_description' => fake()->name(),
            'product_price' => fake()->randomDigit(),
            'product_quantity' => 25,
            'product_status' => "1",
            "category_id" => \App\Models\Category::factory(),
            'product_slug' => Str::slug(fake()->name(), '-'),
            'product_code' => fake()->name(),
            'product_tags' => fake()->name(),
        ];
    }

    /**
     * Indicate that the model's email address should be unverified.
     *
     * @return static
     */
    public function unverified()
    {
        return $this->state(fn (array $attributes) => [
            'email_verified_at' => null,
        ]);
    }
}
