<?php

namespace App\Repositories\trip;

use Illuminate\Contracts\Pagination\Paginator;

/**
 * Interface TripRepositoryInterface
 *
 * @package App\Repositories
 */
interface TripRepositoryInterface
{
    /**
     * Get paginated trips with associated data.
     *
     * @param int $perPage The number of trips per page.
     * @return \Illuminate\Contracts\Pagination\Paginator
     */
    public function paginate(int $perPage=50): Paginator;

    /**
     * Get a specific trip by its ID.
     *
     * @param int $tripId The ID of the trip.
     * @return \stdClass|null
     */
    public function findById(int $tripId): ?\stdClass;

    /**
     * Find trips associated with a specific order by order ID.
     *
     * @param int $orderId The ID of the order.
     * @param int $perPage The number of trips per page.
     * @return \Illuminate\Contracts\Pagination\Paginator
     */
    public function findByOrder(int $orderId, int $perPage=50): Paginator;

    /**
     * Create a new trip record.
     *
     * @param array $data The data for the new trip.
     * @return int The ID of the created trip.
     */
    public function create(array $data): int;

    /**
     * Update an existing trip record.
     *
     * @param int $tripId The ID of the trip to update.
     * @param array $data The updated data for the trip.
     * @return bool True if the update is successful, false otherwise.
     */
    public function update(int $tripId, array $data): bool;

    /**
     * Delete a trip record.
     *
     * @param int $tripId The ID of the trip to delete.
     * @return bool True if the deletion is successful, false otherwise.
     */
    public function delete(int $tripId): bool;
}
