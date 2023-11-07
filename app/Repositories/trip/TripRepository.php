<?php

namespace App\Repositories\trip;

use App\Models\Trip;
use Illuminate\Contracts\Pagination\Paginator;
use Illuminate\Support\Facades\DB;

class TripRepository implements TripRepositoryInterface
{
    /**
     * Get paginated trips with associated data.
     *
     * @param int $perPage The number of trips per page.
     * @return \Illuminate\Contracts\Pagination\Paginator
     */
    public function paginate(int $perPage = 50): Paginator
    {
        return DB::table('trips as t')
            ->select('t.*', 'u.name as driver_name', 'u.family as driver_family')
            ->join('users as u', 't.driver_id', '=', 'u.id')
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
     * Find trips associated with a specific order by order ID.
     *
     * @param int $orderId The ID of the order.
     * @param int $perPage The number of trips per page.
     * @return \Illuminate\Contracts\Pagination\Paginator
     */
    public function findByOrder(int $orderId, int $perPage = 50): Paginator
    {
        return DB::table('trips as t')
            ->select('t.*', 'u.name as driver_name', 'u.family as driver_family')
            ->join('users as u', 't.driver_id', '=', 'u.id')
            ->join('orders as o', 't.order_id', '=', 'o.id')
            ->where('t.order_id', $orderId)
            ->paginate($perPage);
    }

    /**
     * Create a new trip with the provided data.
     *
     * @param array $data The data for creating the trip. Should include 'user_id', 'order_id', 'status', and other optional fields.
     * @return Trip The newly created Trip instance.
     */
    public function create(array $data): Trip
    {
        return Trip::with("vendor")->create($data);
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
