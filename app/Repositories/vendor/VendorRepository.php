<?php

namespace App\Repositories\vendor;

use App\Models\Vendor;
use Illuminate\Support\Facades\DB;

/**
 * Class VendorRepository
 *
 * @package App\Repositories
 */
class VendorRepository implements VendorRepositoryInterface
{
    /**
     * Get all vendors.
     *
     * @return \Illuminate\Database\Eloquent\Collection|Vendor[]
     */
    public function all()
    {
        return Vendor::all();
    }

    /**
     * Find a vendor by ID.
     *
     * @param int $id
     * @return Vendor|null
     */
    public function find(int $id)
    {
        return Vendor::find($id);
    }

    /**
     * Find a vendor randomly.
     *
     * @return \stdClass|null
     */
    public function findRandomly()
    {
        $orderVendor=DB::table("orders as o")->select(["o.id as orderId","v.id as vendorId"])
            ->join('vendors as v','v.id','=','o.vendor_id');
        return DB::table('delay_reports as dr')->select(["ov.vendorId"])
            ->joinSub($orderVendor,'ov','ov.orderId','=','dr.order_id')
            ->inRandomOrder()
            ->first();
    }

    /**
     * Create a new vendor.
     *
     * @param array $data
     * @return Vendor
     */
    public function create(array $data)
    {
        return Vendor::create($data);
    }

    /**
     * Update a vendor by ID.
     *
     * @param int $id
     * @param array $data
     * @return bool Returns true if the order has been processed successfully, false otherwise.
     */
    public function update(int $id, array $data)
    {

        $vendor = Vendor::where('id', $id)->update($data);
        if ($vendor) {
            return true;
        }
        return false;
    }

    /**
     * Delete a vendor by ID.
     *
     * @param int $id
     * @return bool
     */
    public function delete(int $id)
    {
        $vendor = Vendor::where("id", $id)->delete();
        if ($vendor) {
            return true;
        }
        return false;
    }
}
