<?php

namespace App\Repositories\trip;

use Illuminate\Contracts\Pagination\Paginator;
use Illuminate\Support\Facades\DB;

class TripsRepository implements TripsRepositoryInterface
{
    /**
     * Get paginated trips with associated data.
     *
     * @param int $perPage The number of trips per page.
     * @return \Illuminate\Contracts\Pagination\Paginator
     */
    public function paginate(int $perPage): Paginator
    {
        return DB::table('trips as t')
            ->select('t.*', 'd.name as driver_name', 'd.family as driver_family')
            ->join('drivers as d', 't.driver_id', '=', 'd.id')
            ->paginate($perPage);
    }

    /**
     * Get a specific trip by its ID.
     *
     * @param int $tripId The ID of the trip.
     * @return \stdClass|null
     */
    public function findById(int $tripId): ?\stdClass
    {
        return DB::table('trips')->where('id', $tripId)->first();
    }

    /**
     * Create a new trip record.
     *
     * @param array $data The data for the new trip.
     * @return int The ID of the created trip.
     */
    public function create(array $data): int
    {
        return DB::table('trips')->insertGetId($data);
    }

    /**
     * Update an existing trip record.
     *
     * @param int $tripId The ID of the trip to update.
     * @param array $data The updated data for the trip.
     * @return bool True if the update is successful, false otherwise.
     */
    public function update(int $tripId, array $data): bool
    {
        return DB::table('trips')->where('id', $tripId)->update($data);
    }

    /**
     * Delete a trip record.
     *
     * @param int $tripId The ID of the trip to delete.
     * @return bool True if the deletion is successful, false otherwise.
     */
    public function delete(int $tripId): bool
    {
        return DB::table('trips')->where('id', $tripId)->delete();
    }
}
