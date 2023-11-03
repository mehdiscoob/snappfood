<?php

namespace App\Repositories\trip;

use Illuminate\Contracts\Pagination\Paginator;

/**
 * Interface TripsRepositoryInterface
 *
 * @package App\Repositories
 */
interface TripsRepositoryInterface
{
    /**
     * Get paginated trips with associated data.
     *
     * @param int $perPage The number of trips per page.
     * @return \Illuminate\Contracts\Pagination\Paginator
     */
    public function paginate(int $perPage): Paginator;

    /**
     * Get a specific trip by its ID.
     *
     * @param int $tripId The ID of the trip.
     * @return \stdClass|null
     */
    public function findById(int $tripId): ?\stdClass;

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
