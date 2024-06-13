<?php

namespace App\Models\Order;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

/**
 * @mixin Builder
 */

class Delivery extends Model
{
    protected $table = 'order_deliveries';

    protected $fillable = [
        'threshold',
        'amount'
    ];
}

