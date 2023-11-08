<?php

namespace App\Repositories\vendor;

use App\Models\Vendor;

interface VendorRepositoryInterface
{
    /**
     * Get all vendors.
     *
     * @return \Illuminate\Database\Eloquent\Collection|Vendor[]
     */
    public function all();

    /**
     * Find a vendor by ID.
     *
     * @param int $id
     * @return Vendor|null
     */
    public function find(int $id);

    /**
     * Find a vendor randomly.
     *
     * @return \stdClass|null
     */
    public function findRandomly();


    /**
     * Create a new vendor.
     *
     * @param array $data
     * @return Vendor
     */
    public function create(array $data);

    /**
     * Update a vendor by ID.
     *
     * @param int $id
     * @param array $data
     * @return Vendor|null
     */
    public function update(int $id, array $data);

    /**
     * Delete a vendor by ID.
     *
     * @param int $id
     * @return bool
     */
    public function delete(int $id);
}
