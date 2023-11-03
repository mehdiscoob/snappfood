<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class OrderDetail
 *
 * @package App\Models
 *
 * @property int $id
 * @property int $quantity The quantity of the product in the order detail.
 * @property int $order_id The ID of the order associated with the detail.
 * @property int $product_id The ID of the product associated with the detail.
 *
 * @property Order $order The order associated with the detail.
 * @property Product $product The product associated with the detail.
 */
class OrderDetail extends Model
{
    use SoftDeletes;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'quantity',
        'order_id',
        'product_id',
    ];

    /**
     * Get the order associated with the detail.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function order()
    {
        return $this->belongsTo(Order::class);
    }

    /**
     * Get the product associated with the detail.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
