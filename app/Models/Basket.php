<?php

namespace App\Models;

use App\Models\Order\Delivery;
use App\Models\Product\Offer;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

/**
 * @mixin Builder
 */

class Basket extends Model
{
    protected $table = 'basket';

    protected $fillable = [
        'products'
    ];

    protected $casts =[
        'products' => 'array'
    ];

    public function getProducts()
    {
        return Product::find(array_keys($this?->products ?? []))->keyBy('id');
    }

    public function calculate(): array
    {
        $result = [
            'total' => 0,
            'delivery' => 0,
            'discount' => 0
        ];
        $products = Product::find(array_keys($this?->products ?? []))->keyBy('id');
        foreach ($products as $product) {
            $basketProduct = $this->products[$product->id];
            $prices = array_fill(0, $basketProduct['qty'], $basketProduct['price']);
            foreach ($product->offers()->orderByDesc('discount_quantity')->get() as $offer) {
                if ($basketProduct['qty'] >= $offer->discount_quantity) {
                    for ($i = $offer->discount_quantity - 1; $i <= count($prices) - 1; $i += $offer->discount_quantity) {
                        $price = $prices[$i];
                        if ($offer->discount_type == 'percentage') {
                            $discount = round(($basketProduct['price'] / 100 * $offer->discount_amount), 2);
                        } else {
                            $discount = $offer->discount_amount;
                        }
                        $result['discount'] += $discount;
                        $price -= $discount;
                        $price = $prices < 0 ? 0 : $price;
                        $prices[$i] = $price;
                    }
                }
            }
            $result['total'] += array_sum($prices);
        }

        if ($result['total'] > 0) {
            $deliveries = Delivery::all()->sortByDesc('threshold');
            foreach ($deliveries as $delivery) {
                if ($result['total'] > $delivery->threshold) {
                    $result['total'] += $delivery->amount;
                    $result['delivery'] += $delivery->amount;
                    break;
                }
            }
        }

        return $result;
    }
}