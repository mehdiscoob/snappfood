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
        try {
            $response = $this->delayReportService->create($data);
            $this->assertTrue($response);
        } catch (\Symfony\Component\HttpKernel\Exception\HttpException $e) {
            $this->assertTrue(in_array($e->getStatusCode(), [423,422,401,400]));
        }
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
        try {
            $response = $this->delayReportService->assignDelayReportToAgent();
            $this->assertInstanceOf(\stdClass::class, $response);
        } catch (\Symfony\Component\HttpKernel\Exception\HttpException $e) {
            $this->assertTrue(in_array($e->getStatusCode(), [403, 422, 404]));
        }
    }

}
