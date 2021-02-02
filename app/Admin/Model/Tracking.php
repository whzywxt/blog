<?php

namespace App\Admin\Model;

use Illuminate\Database\Eloquent\Model;

class Tracking extends Model
{
    // table
    protected $table = 'tracking';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'tracking_number', 'merchant_order_number', 'waybill_number', 'operator_id'
    ];
}
