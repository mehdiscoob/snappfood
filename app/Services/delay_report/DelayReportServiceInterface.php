<?php

namespace App\Services\delay_report;

interface DelayReportServiceInterface
{
    /**
     * Create a delay report for an order.
     *
     * @param array $data
     * @return array
     * @throws \Exception
     */
    public function create(array $data);

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
     * @return \Illuminate\Http\JsonResponse
     */
    public function assignDelayReportToAgent(): \Illuminate\Http\JsonResponse;
}
