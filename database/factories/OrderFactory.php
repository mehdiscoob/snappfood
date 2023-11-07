<?php

namespace Database\Factories;

use App\Models\Order;
use App\Models\User;
use App\Models\Vendor;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class OrderFactory extends Factory
{
    protected $model = Order::class;

    public function definition()
    {   $user_id=User::pluck("id");
       $vendor_id=Vendor::pluck("id");
        return [
            'orderNumber' => Str::uuid(),
            'vendor_id' => function ()use($vendor_id) {
                return $this->faker->randomElement($vendor_id);
            },
            'user_id' => function () use($user_id){
                return $this->faker->randomElement($user_id);
            },
            'delivery_time' => $this->faker->dateTimeBetween('-2 hour', '+1 hour'),
            'total_price' => $this->faker->randomFloat(2, 10, 100),
            'total_count' => $this->faker->numberBetween(1, 10),
        ];
    }
}
