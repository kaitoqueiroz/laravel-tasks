<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'customer_id', 'subscription_id', 'status', 'total'
    ];

    public function customer()
    {
        return $this->belongsTo('App\Models\Customer');
    }
}
