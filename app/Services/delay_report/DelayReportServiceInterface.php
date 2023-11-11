<?php

namespace App\Services\delay_report;

use App\Models\DelayReport;

interface DelayReportServiceInterface
{
    /**
     * Create a delay report for an order.
     *
     * @param array $data
     * @return bool
     * @throws \Exception
     */
    public function create(array $data):\Illuminate\Http\JsonResponse|bool;

    /**
     * Get delay reports for a specific vendor, ordered by delay time.
     *
     * @param int $vendor_id
     * @return mixed
     */
    public function getReportByVendorOrderByDelayTime(int $vendor_id);

    /**
     * Assign an open delay report to an agent.
     *
     * @return \stdClass
     */
    public function assignDelayReportToAgent(): \stdClass;
}
