<?php

namespace App\Models\Product;

use App\Models\Product;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @mixin Builder
 */

class Offer extends Model
{
    protected $table = 'product_offers';

    protected $fillable = [
        'product_id',
        'discount_quantity',
        'discount_type',
        'discount_amount'
    ];

    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class, 'product_id');
    }
}