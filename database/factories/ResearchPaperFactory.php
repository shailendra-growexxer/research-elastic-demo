<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\ResearchPaper>
 */
class ResearchPaperFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title' => $this->faker->sentence,
            'abstract' => $this->faker->paragraph(5),
            'publication_date' => $this->faker->dateTimeBetween('-10 years', 'now')->format('Y-m-d'),
            // 'institution_id' will be set in the seeder
        ];
    }
}
