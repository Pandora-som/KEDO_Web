<?php

namespace Database\Factories;

use App\Models\Status;
use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Classificators;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\IncomingLetter>
 */
class IncomingLetterFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'registration_date' => $this->faker->dateTimeInInterval('-1 days', '+10 days'),
            'document_from' => $this->faker->name(),
            'document_name' => $this->faker->name(),
            'document_number' => random_int(1, 2000),
            'document_date' => $this->faker->dateTimeInInterval('-1 days', '+10 days'),
            'document_subject' => $this->faker->text(),
            'resolution' => $this->faker->text(),
            'performer' => $this->faker->name(),
            'deadline' => $this->faker->dateTimeInInterval('-1 days', '+10 days'),
            'status_id' => Status::get()->random()->id,
            'classificator_id' => Classificators::get()->random()->id
        ];
    }
}
