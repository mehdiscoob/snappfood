<?php



namespace Database\Factories;

use App\Models\DelayReport;
use App\Models\Order;
use Illuminate\Database\Eloquent\Factories\Factory;

class DelayReportFactory extends Factory
{
    protected $model = DelayReport::class;

    public function definition()
    {
        $order=Order::whereNotIn("id",[1,2,3,4])->pluck("id");
        return [
            'order_id' => function () use($order){
                return $this->faker->randomElement($order);
            },
            'delay_time' => $this->faker->randomNumber(2),
            'status' => $this->faker->randomElement(['c','o']),
        ];
    }
}
