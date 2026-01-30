<?php

namespace Database\Factories;

use App\Models\Tim;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Tim>
 */
class TimFactory extends Factory
{

    protected $model = Tim::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'naziv' => fake()->company(),   
            'grad' => fake()->city(),
        ];
    }
}
