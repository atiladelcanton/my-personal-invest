<?php

namespace Database\Factories;

use App\Models\{TypeInvestiment, User};
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<TypeInvestiment>
 */
class TypeInvestimentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id'    => User::factory(),
            'name'       => fake()->name,
            'percentage' => fake()->randomDigit(),
        ];
    }
}
