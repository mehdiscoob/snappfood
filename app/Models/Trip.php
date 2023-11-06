<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Trip
 *
 * @package App\Models
 *
 * @property int $id
 * @property string $status The status of the trip.
 * @property int $driver_id The ID of the driver assigned to the trip.
 * @property int $order_id The ID of the order associated with the trip.
 *
 * @property Driver $driver The driver assigned to the trip.
 * @property Order $order The order associated with the trip.
 */
class Trip extends Model
{
    use SoftDeletes;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'status',
        'driver_id',
        'order_id',
    ];


    /**
     * Get the order associated with the trip.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function order()
    {
        return $this->belongsTo(Order::class);
    }

    /**
     * Get the user associated with the trip.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

}
