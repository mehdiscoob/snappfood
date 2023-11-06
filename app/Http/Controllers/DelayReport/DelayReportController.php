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
     * @return JsonResponse
     */
    public function createDelayTime(CreateDelayReportRequest $request): JsonResponse
    {
      return $this->delayReportService->create($request->all());
    }

    /**
     * Get delay reports for a specific vendor, ordered by delay time.
     *
     * @param int $id
     * @return JsonResponse
     */
    public function getByReportOrderByDelayTime(int $id): JsonResponse
    {
        $delayReports = $this->delayReportService->getReportByVendorOrderByDelayTime($id);
        return response()->json($delayReports, 200);
    }
}
