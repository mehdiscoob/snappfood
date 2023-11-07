<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Order;
use App\Models\DelayReport;

class DelayReportSeeder extends Seeder
{
    public function run()
    {
            DelayReport::factory()->count(100)->create();
    }
}
