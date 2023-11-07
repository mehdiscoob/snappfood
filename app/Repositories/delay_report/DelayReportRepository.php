<?php

namespace App\Repositories\delay_report;

use App\Models\DelayReport;
use Illuminate\Contracts\Pagination\Paginator;
use Illuminate\Support\Facades\DB;

/**
 * Class DelayReportRepository
 *
 * @package App\Repositories
 */
class DelayReportRepository implements DelayReportRepositoryInterface
{
    /**
     * Get paginated delay reports.
     *
     * @param int $perPage The number of delay reports per page.
     * @return \Illuminate\Contracts\Pagination\Paginator
     */
    public function paginate(int $perPage=50): Paginator
    {
        return DB::table('delay_reports')->paginate($perPage);
    }

    /**
     * Get a specific delay report by its ID.
     *
     * @param int $delayReportId The ID of the delay report.
     * @return \stdClass|null
     */
    public function findById(int $delayReportId): ?\stdClass
    {
        return DB::table('delay_reports')->where('id', $delayReportId)->first();
    }

    /**
     * Check if there is an open delay report of type "o" associated with the given order ID.
     *
     * @param int $order_id The ID of the order to check for an open delay report.
     *
     * @return bool True if an open delay report of type "o" exists for the given order ID, false otherwise.
     */
    public function openDelayReportByOrder(int $order_id): bool
    {
        return DB::table('delay_reports')->where('order_id', $order_id)->where("status","o")->exists();
    }

    /**
     * Create a new delay report.
     *
     * @param array $data The data for the delay report.
     *
     * @return \App\Models\DelayReport The created delay report instance.
     */
    public function create(array $data): DelayReport
    {
        return DelayReport::create($data);
    }

    /**
     * Update an existing delay report record.
     *
     * @param int $delayReportId The ID of the delay report to update.
     * @param array $data The updated data for the delay report.
     * @return bool True if the update is successful, false otherwise.
     */
    public function update(int $delayReportId, array $data): bool
    {
        return DB::table('delay_reports')->where('id', $delayReportId)->update($data);
    }

    /**
     * Delete a delay report record.
     *
     * @param int $delayReportId The ID of the delay report to delete.
     * @return bool True if the deletion is successful, false otherwise.
     */
    public function delete(int $delayReportId): bool
    {
        return DB::table('delay_reports')->where('id', $delayReportId)->delete();
    }


    /**
     * Get delay reports for a specific vendor, ordered by delay time.
     *
     * @param int $vendor_id The ID of the vendor for which delay reports are retrieved.
     * @param int $perPage The number of delay reports per page. Defaults to 50 if not specified.
     *
     * @return \Illuminate\Contracts\Pagination\Paginator
     */
    public function getByReportOrderByDelayTime(int $vendor_id,int $perPage=50): Paginator
    {
        $orderVendor=DB::table("orders as o")->select(["o.id as orderId","v.name as vendorName","o.orderNumber"])
            ->join('vendors as v','v.id','=','o.vendor_id');
        return DB::table('delay_reports as dr')->select(["dr.*","ov.vendorName","ov.orderNumber"])
            ->joinSub($orderVendor,'ov','ov.orderId','=','dr.order_id')
            ->orderBy("dr.delay_time")
            ->paginate($perPage);
    }

    /**
     * Check if an agent has an open delay report.
     *
     * @param int $userId The ID of the agent.
     *
     * @return bool True if the agent has an open delay report of type "o", false otherwise.
     */
    public function agentHasDelayReport(int $userId): bool
    {
        return DB::table("delay_reports")->whereNull("deleted_at")->where('status', 'o')
            ->where("user_id", $userId)->exists();
    }

    /**
     * Get the oldest open delay report of type "o" and assign it to the given agent ID.
     *
     * @param int $agentId The ID of the agent to assign the delay report.
     * @return \stdClass|null The assigned delay report instance, or null if no suitable delay report is found.
     */
    public function assignDelayReportToAgent(int $agentId): ?\stdClass
    {
        $oldestDelayReport = DB::table('delay_reports')
            ->where('status', 'o')
            ->orderBy('created_at')
            ->lockForUpdate()
            ->first();

        if ($oldestDelayReport) {
            DB::table('delay_reports')
                ->where('id', $oldestDelayReport->id)
                ->update([
                    'user_id' => $agentId,
                ]);
            return $oldestDelayReport;
        }
        return null;
    }
}
