<?php

namespace App\Services\order;

use App\Models\Order;

interface OrderServiceInterface
{
    /**
     * Create a new order with the provided data.
     *
     * @param array $data The data for the new order.
     *
     * @return Order The created order instance.
     *
     * @throws \Exception If there is an error while creating the order.
     */
    public function create(array $data): Order;


    /**
     * Find an order by its ID.
     *
     * @param int $id The ID of the order to find.
     *
     * @return Order|null The found order instance or null if not found.
     */
    public function findById(int $id): ?Order;

    /**
     * Find an order by Randomly.
     *
     * @return Order|null
     */
    public function findRandomly(): ?Order;

    /**
     * Check if an order has associated trips.
     *
     * @param int $id The ID of the order.
     * @return \stdClass|null An object containing order ID, user ID, and associated trip ID if trips exist, or null otherwise.
     */
    public function hasTrips(int $id): \stdClass;

    /**
     * Update an existing order with new data.
     *
     * @param int $id The ID of the order to update.
     * @param array $data The updated data for the order.
     * @return bool True if the update is successful, false otherwise.
     */
    public function update(int $id, array $data): bool;
}
