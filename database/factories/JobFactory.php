<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Faker\Generator as Faker;
use App\Models\User;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Job>
 */
class JobFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
{
    return [
        'user_id' => User::factory(),
        'title' => substr($this->faker->jobTitle(), 0, 255),
       'description' => substr($this->faker->paragraphs(2, true), 0, 1000),  // Limiting to 1000 characters
        'salary' => $this->faker->numberBetween(40000, 120000),
        'tags' => substr(implode(',', $this->faker->words(3)), 0, 255),  // Limiting to 255 characters
        'job_type' => $this->faker->randomElement(['Full-Time', 'Part-Time', 'Contract']),
        'remote' => $this->faker->boolean(),
        'requirements' => substr($this->faker->sentences(3, true), 0, 255),  // Limiting to 255 characters
        'benefits' => substr($this->faker->sentences(2, true), 0, 255),  // Limiting to 255 characters
        'address' => $this->faker->streetAddress(),
        'city' => $this->faker->city(),
        'state' => $this->faker->state(),
        'zipcode' => $this->faker->postcode(),
        'contact_email' => $this->faker->safeEmail(),
        'contact_phone' => $this->faker->phoneNumber(),
        'company_name' => substr($this->faker->company(), 0, 255),  // Limiting to 255 characters
        'company_description' => substr($this->faker->paragraphs(2, true), 0, 255),  // Limiting to 255 characters
        'company_logo' => $this->faker->imageUrl(100, 100, 'business', true, 'logo'),
        'company_website' => $this->faker->url(),
    ];
}

}
