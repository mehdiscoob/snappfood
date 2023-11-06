<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class DelayReport
 *
 * @package App\Models
 *
 * @property int $id
 * @property string $status The status of the delay report.
 * @property int $type The type of the delay report (0 or 1).
 * @property int $delay_time The delay time specified in the report.
 * @property int $order_id The ID of the order associated with the report.
 * @property int $agent_id The ID of the agent associated with the report.
 *
 * @property Order $order The order associated with the report.
 * @property Agent $agent The agent associated with the report.
 */
class DelayReport extends Model
{
    use SoftDeletes;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'status',
        'type',
        'delay_time',
        'order_id',
        'agent_id',
    ];

    /**
     * Get the order associated with the report.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function order()
    {
        return $this->belongsTo(Order::class);
    }


    /**
     * Get the user associated with the delay_report.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
