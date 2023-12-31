<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Order
 *
 * @package App\Models
 *
 * @property int $id
 * @property string $delivery_time The delivery time of the order.
 * @property float $total_price The total price of the order.
 * @property int $total_count The total count of products in the order.
 * @property int $vendor_id The ID of the vendor associated with the order.
 *
 * @property Vendor $vendor The vendor associated with the order.
 * @property OrderDetail[] $products The products included in the order.
 */
class Order extends Model
{
    use HasFactory,SoftDeletes;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'delivery_time',
        'total_price',
        'total_count',
        'orderNumber',
        'vendor_id',
        'user_id',
    ];

    /**
     * Get the vendor associated with the order.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function vendor()
    {
        return $this->belongsTo(Vendor::class);
    }

    /**
     * Get the products included in the order.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function products()
    {
        return $this->belongsToMany(Product::class,'orderdetails');
    }

    /**
     * Get the trip included in the order.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function trip()
    {
        return $this->hasOne(Trip::class);
    }

    /**
     * Get the user associated with the order.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the delay_reports placed with the order.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function delay_report()
    {
        return $this->hasMany(DelayReport::class);
    }
}
