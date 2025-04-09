<?php

namespace Database\Factories;

use App\Models\Jobs;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Jobs>
 */
class JobsFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
            return [
                'title' => $this->faker->jobTitle,
                'job_category_id' => $this->faker->numberBetween(1, 5),
                'job_type_id' => $this->faker->numberBetween(1, 5),
                'user_id' => 3,
                'vacancy' => $this->faker->numberBetween(1, 10),
                'location' => $this->faker->city,
                'description' => $this->faker->paragraphs(3, true),
                'responsibility' => $this->faker->paragraphs(2, true),
                'qualifications' => $this->faker->paragraphs(2, true),
                'experience' => $this->faker->numberBetween(1, 10),
                'company_name' => $this->faker->company,
                'company_location' => $this->faker->address,
                'company_industry' => $this->faker->company,
                'company_website' => $this->faker->url,
                'created_at' => now(),
                'updated_at' => now(),
            ];
    }
}
