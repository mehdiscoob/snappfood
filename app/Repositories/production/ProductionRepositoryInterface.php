<?php

namespace App\Repositories\production;

use Illuminate\Contracts\Pagination\Paginator;

/**
 * Interface ProductionRepositoryInterface
 *
 * @package App\Repositories
 */
interface ProductionRepositoryInterface
{
    /**
     * Get paginated food productions.
     *
     * @param int $perPage The number of productions per page.
     * @return \Illuminate\Contracts\Pagination\Paginator
     */
    public function paginate(int $perPage=50): Paginator;

    /**
     * Get a specific food production by its ID.
     *
     * @param int $productionId The ID of the production.
     * @return \stdClass|null
     */
    public function findById(int $productionId): ?\stdClass;

    /**
     * Create a new food production record.
     *
     * @param array $data The data for the new production.
     * @return int The ID of the created production.
     */
    public function create(array $data): int;

    /**
     * Update an existing food production record.
     *
     * @param int $productionId The ID of the production to update.
     * @param array $data The updated data for the production.
     * @return bool True if the update is successful, false otherwise.
     */
    public function update(int $productionId, array $data): bool;

    /**
     * Delete a food production record.
     *
     * @param int $productionId The ID of the production to delete.
     * @return bool True if the deletion is successful, false otherwise.
     */
    public function delete(int $productionId): bool;
}
