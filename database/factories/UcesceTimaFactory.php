<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\UcesceTima>
 */
class UcesceTimaFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'dogadjajId' => SportskiDogadjaj::factory(),
            'timId' => Tim::factory(),
            
            'uloga' => fake()->randomElement(['DOMACIN','GOST','UCESNIK',]),
        ];
    }
}
