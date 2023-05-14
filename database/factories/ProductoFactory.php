<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class ProductoFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'nombre' => fake()->words(2,true),
            'precio' => fake()->randomFloat(2,30,500),
            'categoria' => fake()->randomElement(['shampoo','acondicionador','jabón','crema','pasta dental']),
            'descripcion' => fake()->sentence(10),
            'pedidos' => fake()->numberBetween(0,200)
        ];
    }
}
