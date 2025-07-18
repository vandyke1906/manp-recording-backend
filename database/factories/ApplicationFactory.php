<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Application>
 */
class ApplicationFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $businessName = $this->faker->company;

        return [
             'application_date' => $this->faker->date(),
            'first_name' => $this->faker->firstName,
            'middle_name' => $this->faker->firstName,
            'last_name' => $this->faker->lastName,
            'suffix' => $this->faker->optional()->suffix,
            'email_address' => $this->faker->unique()->safeEmail,
            'contact_number' => $this->faker->phoneNumber,
            'address' => $this->faker->address,
            'application_type_id' => 1,
            'user_id' => 1, // You can randomize if users exist
            'business_name' => $this->faker->company,
            'business_address' => $this->faker->address,
            'business_description' => $this->faker->catchPhrase,
            'business_nature_id' => rand(1, 5),
            'business_status_id' => rand(1, 3),
            'capitalization_id' => rand(1, 4),
            'business_type_id' => rand(1, 3),
            'zoning_id' => rand(1, 2), // Add this if zoning is required
        ];
    }
}
