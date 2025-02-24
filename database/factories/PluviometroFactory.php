<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Pluviometro>
 */
class PluviometroFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [

            'id_usuario' => \App\Models\User::factory(), // Relación con el modelo User
            'cantidad_lluvia' => $this->faker->randomFloat(2, 0, 100), // Número decimal entre 0 y 100
            'latitude' => $this->faker->latitude(-90, 90), // Latitud aleatoria
            'longitude' => $this->faker->longitude(-180, 180),
            //
        ];
    }
}
