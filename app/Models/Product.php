<?php

namespace App\Models;

use App\Models\Product\Offer;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @mixin Builder
 */
class Product extends Model
{
    protected $table = 'products';

    protected $fillable = [
        'name',
        'code',
        'price'
    ];

    public function offers(): HasMany
    {
        return $this->hasMany(Offer::class, 'product_id');
    }

    public static function getByCode($code)
    {
        return static::where('code', $code)->first();
    }
}