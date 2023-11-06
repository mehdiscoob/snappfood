<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Product
 *
 * @package App\Models
 *
 * @property int $id
 * @property string $name The name of the product.
 * @property float $price The price of the product.
 * @property int $count The count of available products.
 * @property int $vendor_id The ID of the vendor associated with the product.
 *
 * @property Vendor $vendor The vendor associated with the product.
 * @property OrderDetail[] $orders The orders in which the product is included.
 */
class Product extends Model
{
    use HasFactory,SoftDeletes;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'price',
        'count',
        'vendor_id',
    ];

    /**
     * Get the vendor associated with the product.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function vendor()
    {
        return $this->belongsTo(Vendor::class);
    }

    /**
     * Get the orders in which the product is included.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function orders()
    {
        return $this->belongsToMany(Order::class,'orderdetails');
    }
}
