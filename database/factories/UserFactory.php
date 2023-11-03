<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class UserFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = User::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->name,
            'email' => $this->faker->unique()->safeEmail,
            'mobile' => $this->faker->unique()->phoneNumber, // Assuming you want random phone numbers
            'verification_code' => null,
            'email_verified_at' => now(),
            'mobile_verified_at' => now(),
            'password' => bcrypt('password'), // Default password for all users (you can customize this)
            'api_token' => \Illuminate\Support\Str::random(60), // Generate a random API token
            'verified' => true, // Assuming you want all users to be verified
            'remember_token' => \Illuminate\Support\Str::random(10),
        ];
    }
}
