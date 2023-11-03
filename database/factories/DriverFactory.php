<?php

namespace Database\Factories;

use App\Models\Driver;
use Illuminate\Database\Eloquent\Factories\Factory;

class DriverFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Driver::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->name,
            'family' => $this->faker->lastName,
            'national_code' => $this->faker->unique()->numerify('###########'), // 11-digit unique numeric code
            'birthday' => $this->faker->date,
            'mobile_number' => $this->faker->unique()->phoneNumber,
        ];
    }
}
