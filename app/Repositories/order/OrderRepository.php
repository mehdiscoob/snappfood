<?php

namespace App\Repositories\order;

use App\Models\Order;
use Illuminate\Support\Facades\DB;

/**
 * Class OrderRepository
 *
 * @package App\Repositories
 */
class OrderRepository implements OrderRepositoryInterface
{
    /**
     * Get all orders with associated products, order details, vendors, and drivers for pagination.
     *
     * @return \Illuminate\Pagination\Paginator
     */
    public function all()
    {
        $products = DB::table('products as p')->select("od.id as odId", "p.name as product_name")
            ->join('orderdetails as od', 'p.id', '=', 'od.id');
        $trips = DB::table("trips as t")->select("CONCAT('d.name d.family') as driver_name", "t.*")
            ->join("drivers as d", 'd.id', '=', 't.driver_id');
        return DB::table("orders as o")
            ->join('vendors as v', 'o.vendor_id', '=', 'v.id')
            ->joinSub($products, 'op', 'op.odId', '=', 'o.id')
            ->joinSub($trips, 'ot', 'ot.order_id', '=', 'o.id')
            ->paginate(50);
    }

    /**
     * Find an order by ID.
     *
     * @param int $id
     * @return Order|null
     */
    public function find(int $id)
    {
        return Order::find($id);
    }

    /**
     * Create a new order.
     *
     * @param array $data
     * @return Order
     */
    public function create(array $data)
    {
        return Order::create($data);
    }

    /**
     * Update an order by ID.
     *
     * @param int $id
     * @param array $data
     * @return bool Returns true if the order has been processed successfully, false otherwise.
     */
    public function update(int $id, array $data)
    {
        $order = Order::where("id", $id)->update($data);
        if ($order) {
            return true;
        }
        return false;
    }

    /**
     * Delete an order by ID.
     *
     * @param int $id
     * @return bool
     */
    public function delete(int $id)
    {
        $order = Order::where("id",$id)->delete();
        if ($order) {
            return true;
        }
        return false;
    }
}
