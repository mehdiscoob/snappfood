<?php

namespace App\Services\order;

interface OrderServiceInterface
{
    /**
     * Create a new order with additional data.
     *
     * @param array $data The data for the new order.
     * @return array The created order data.
     */
    public function create(array $data): array;

    /**
     * Find an order by its ID.
     *
     * @param int $id The ID of the order.
     * @return array|null The order data, or null if not found.
     */
    public function findById(int $id): ?array;

    /**
     * Check if an order has associated trips.
     *
     * @param int $id The ID of the order.
     * @return bool True if the order has trips, false otherwise.
     */
    public function hasTrips(int $id): bool;

    /**
     * Update an existing order with new data.
     *
     * @param int $id The ID of the order to update.
     * @param array $data The updated data for the order.
     * @return bool True if the update is successful, false otherwise.
     */
    public function update(int $id, array $data): bool;
}
