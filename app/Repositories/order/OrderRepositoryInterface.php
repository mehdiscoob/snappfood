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
     * Delete an order by ID.
     *
     * @param int $id
     * @return bool
     */
    public function delete(int $id);
}
