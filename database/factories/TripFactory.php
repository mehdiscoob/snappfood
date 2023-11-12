<?php

namespace Database\Factories;

use App\Models\Order;
use App\Models\Trip;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class TripFactory extends Factory
{
    protected $model = Trip::class;

    public function definition()
    {
        $user_id=User::where("role","driver")->pluck("id");
        return [
            'user_id' => $this->faker->randomElement($user_id),
            'order_id' => null,
            'status' => $this->faker->randomElement(['ASSIGNED', 'AT_VENDOR', 'PICKED', 'DELIVERED']),
        ];
    }
}
