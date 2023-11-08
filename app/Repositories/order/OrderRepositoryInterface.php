<?php

namespace App\Repositories\order;

use App\Models\Order;

interface OrderRepositoryInterface
{
    /**
     * Get all orders.
     *
     * @return \Illuminate\Database\Eloquent\Collection|Order[]
     */
    public function all();

    /**
     * Find an order by ID.
     *
     * @param int $id
     * @return Order|null
     */
    public function find(int $id);

    /**
     * Find an order by Randomly.
     *
     * @return Order|null
     */
    public function findRandomly();

    /**
     * Create a new order.
     *
     * @param array $data
     * @return Order
     */
    public function create(array $data);

    /**
     * Update an order by ID.
     *
     * @param int $id
     * @param array $data
     * @return Order|null
     */
    public function update(int $id, array $data);

    /**
     * Check if the order has associated trips.
     *
     * @param int $orderId The ID of the order.
     * @return \stdClass|null An object containing order ID, user ID, and associated trip ID if trips exist, or null otherwise.
     */
    public function hasTrips(int $orderId): ?\stdClass;

    /**
     * Delete an order by ID.
     *
     * @param int $id
     * @return bool
     */
    public function delete(int $id);
}
