<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Vendor
 *
 * @package App\Models
 *
 * @property int $id
 * @property string $name The name of the vendor.
 * @property string $delivery_time The delivery time of the vendor.
 *
 * @property Product[] $products The products provided by the vendor.
 * @property Order[] $orders The orders placed with the vendor.
 */
class Vendor extends Model
{
    use SoftDeletes;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'delivery_time',
    ];

    /**
     * Get the products provided by the vendor.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function products()
    {
        return $this->hasMany(Product::class);
    }

    /**
     * Get the orders placed with the vendor.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function orders()
    {
        return $this->hasMany(Order::class);
    }
}
