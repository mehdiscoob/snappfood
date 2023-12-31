<?php

namespace App\Http\Controllers\DelayReport;

use App\Http\Controllers\Controller;
use App\Http\Requests\DelayReport\CreateDelayReportRequest;
use App\Services\delay_report\DelayReportService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class DelayReportController extends Controller
{
    private $delayReportService;

    /**
     * DelayReportController constructor.
     *
     * @param DelayReportService $delayReportService
     */
    public function __construct(DelayReportService $delayReportService)
    {
        $this->delayReportService = $delayReportService;
    }

    /**
     * Create a new delay report.
     *
     * @param CreateDelayReportRequest $request
     * @return bool
     */
    public function createDelayTime(CreateDelayReportRequest $request): bool
    {
      return $this->delayReportService->create($request->all());
    }

    /**
     * Get delay reports for a specific vendor, ordered by delay time.
     *
     * @param int $id
     * @return mixed
     */
    public function getByReportOrderByDelayTime(int $id): mixed
    {
        return $this->delayReportService->getReportByVendorOrderByDelayTime($id);
    }

    /**
     * Assign an open delay report to the authenticated agent.
     *
     * This method checks if the authenticated user is an agent and assigns an open delay report to them.
     * If the assignment is successful, it returns a success message; otherwise, it provides an appropriate error message.
     *
     * @return \stdClass
     */
    public function assignDelayReportToAgent():\stdClass
    {
        return $this->delayReportService->assignDelayReportToAgent();
    }
}
