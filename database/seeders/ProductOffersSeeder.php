<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Seeder;

class ProductOffersSeeder extends Seeder
{
    public function run()
    {
        $offers = [
            [
                'product_code' => 'R01',
                'discount_quantity' => 2,
                'discount_type' => 'percentage',
                'discount_amount' => 50
            ]
        ];

        foreach ($offers as $offer) {
            $product = Product::getByCode($offer['product_code']);
            unset($offer['product_code']);
            $product?->offers()->create($offer);
        }
    }
}