<?php

namespace App\Repositories\delay_report;

use App\Models\DelayReport;
use Illuminate\Contracts\Pagination\Paginator;

/**
 * Interface DelayReportRepositoryInterface
 *
 * @package App\Repositories
 */
interface DelayReportRepositoryInterface
{
    /**
     * Get paginated delay reports.
     *
     * @param int $perPage The number of delay reports per page.
     * @return \Illuminate\Contracts\Pagination\Paginator
     */
    public function paginate(int $perPage=50): Paginator;

    /**
     * Get a specific delay report by its ID.
     *
     * @param int $delayReportId The ID of the delay report.
     * @return \stdClass|null
     */
    public function findById(int $delayReportId): ?\stdClass;

    /**
     * Check if there is an open delay report of type "o" associated with the given order ID.
     *
     * @param int $order_id The ID of the order to check for an open delay report.
     *
     * @return bool True if an open delay report of type "o" exists for the given order ID, false otherwise.
     */
    public function openDelayReportByOrder(int $order_id): bool;

    /**
     * Create a new delay report.
     *
     * @param array $data The data for the delay report.
     *
     * @return \App\Models\DelayReport The created delay report instance.
     */
    public function create(array $data): DelayReport;

    /**
     * Update an existing delay report record.
     *
     * @param int $delayReportId The ID of the delay report to update.
     * @param array $data The updated data for the delay report.
     * @return bool True if the update is successful, false otherwise.
     */
    public function update(int $delayReportId, array $data): bool;

    /**
     * Delete a delay report record.
     *
     * @param int $delayReportId The ID of the delay report to delete.
     * @return bool True if the deletion is successful, false otherwise.
     */
    public function delete(int $delayReportId): bool;

    /**
     * Get delay reports for a specific vendor, ordered by delay time.
     *
     * @param int $vendor_id The ID of the vendor for which delay reports are retrieved.
     * @param int $perPage The number of delay reports per page. Defaults to 50 if not specified.
     *
     * @return \Illuminate\Contracts\Pagination\Paginator
     */
    public function getByReportOrderByDelayTime(int $vendor_id,int $perPage=50): Paginator;

    /**
     * Check if an agent has an open delay report.
     *
     * @param int $userId The ID of the agent.
     *
     * @return bool True if the agent has an open delay report of type "o", false otherwise.
     */
    public function agentHasDelayReport(int $userId): bool;

    /**
     * Get the oldest open delay report of type "o" and assign it to the given agent ID.
     *
     * @param int $agentId The ID of the agent to assign the delay report.
     * @return \stdClass|null The assigned delay report instance, or null if no suitable delay report is found.
     */
    public function assignDelayReportToAgent(int $agentId): ?\stdClass;
}
