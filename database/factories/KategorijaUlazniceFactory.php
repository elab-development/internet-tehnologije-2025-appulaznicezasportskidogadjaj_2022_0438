<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\KategorijaUlaznica>
 */
class KategorijaUlazniceFactory extends Factory
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

            'naziv' => fake()->randomElement([
                'Tribina A',
                'Tribina B',
                'Parter',
                'VIP loža',
                'Fan Pit',
            ]),

            //TipSedista
            'tipSedista' => fake()->randomElement([
                'REGULAR',
                'VIP',
                'FAN_PIT',
            ]),

            'cena' => fake()->randomFloat(2, 1500, 12000),
            'kapacitet' => fake()->numberBetween(50, 500),
        ];
    }
}
