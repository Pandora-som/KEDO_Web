<?php

namespace Database\Factories;

use App\Models\Classificators;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\OutgoingLetter>
 */
class OutgoingLetterFactory extends Factory
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
            'destination' => $this->faker->name(),
            'document_name' => $this->faker->title(),
            'document_subject' => $this->faker->text(),
            'performer' => $this->faker->name(),
            'signer' => $this->faker->name(),
            'incoming_number' => random_int(1, 2000),
            'classificator_id' => Classificators::get()->random()->id,
        ];
    }
}
