<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Classificators>
 */
class ClassificatorsFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'classificator_name' => ['Сторонние', 'УрФУ', 'МИНОБРНАУКИ', 'НТИ(филиал)'],
        ];
    }
}
