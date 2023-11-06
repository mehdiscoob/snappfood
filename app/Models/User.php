<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use  HasFactory, Notifiable,SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name', 'email','email_verified_at','verification_code',
        'api_token','mobile_verified_at','verified', 'mobile',
        'password',"role"
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    /**
     * Get the orders included in the user.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function order()
    {
        return $this->hasMany(Order::class);
    }

    /**
     * Get the trips included in the user.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function trip()
    {
        return $this->hasMany(Trip::class);
    }

    /**
     * Get the delay_reports included in the user.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function delay_report()
    {
        return $this->hasMany(DelayReport::class);
    }

}
