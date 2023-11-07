<?php

namespace Database\Seeders;

use App\Models\Trip;
use Illuminate\Database\Seeder;
use App\Models\Order;

class OrderSeeder extends Seeder
{
    public function run()
    {
        $orders=Order::factory()->count(20)->create();
        foreach ($orders as $o){
            if (random_int(0,1)==1)Trip::factory()->create(["order_id"=>$o->id]);
        }
    }
}
