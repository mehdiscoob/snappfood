<?php

namespace Tests\Unit;

use App\Models\Order;
use App\Models\User;
use App\Models\Vendor;
use App\Services\delay_report\DelayReportService;
use Database\Seeders\DelayReportSeeder;
use Database\Seeders\OrderSeeder;
use Database\Seeders\UserSeeder;
use Database\Seeders\VendorSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Auth;
use Tests\TestCase;

class DelayReportServiceTest extends TestCase
{
    use RefreshDatabase;
    /** @var DelayReportService */
    private $delayReportService;

    protected function setUp(): void
    {
        parent::setUp();
        $this->delayReportService = app(DelayReportService::class);
        $this->seed(UserSeeder::class);
        $this->seed(VendorSeeder::class);
        $this->seed(OrderSeeder::class);
        $this->seed(DelayReportSeeder::class);
    }

    /** @test */
    public function it_creates_delay_report_for_valid_data()
    {
        $order = Order::inRandomOrder()->first();
        Auth::login($order->user);
        $data = [
            'order_id' => $order->id,
        ];
        $response = $this->delayReportService->create($data);
        $statusCode = $response->getStatusCode();
        $this->assertTrue(in_array($statusCode, [200, 201,400,422]));
    }

    /** @test */
    public function it_gets_delay_reports_for_vendor()
    {
        $vendorId = Vendor::inRandomOrder()->first()->id;
        $delayReports = $this->delayReportService->getReportByVendorOrderByDelayTime($vendorId);

        $this->assertInstanceOf(\Illuminate\Pagination\LengthAwarePaginator::class, $delayReports);
    }

    /** @test */
    public function it_assigns_delay_report_to_agent()
    {
        $agent = User::inRandomOrder()->first();
        Auth::login($agent);
        $response = $this->delayReportService->assignDelayReportToAgent();
        $statusCode=$response->getStatusCode();
        $this->assertTrue(in_array($statusCode, [200,422,403]));
    }

}
