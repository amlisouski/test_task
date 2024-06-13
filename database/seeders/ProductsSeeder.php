<?php


namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Seeder;

class ProductsSeeder extends Seeder
{
    public function run()
    {
        $products = [
            [
                'name' => 'Red Widget',
                'code' => 'R01',
                'price' => 32.95
            ],
            [
                'name' => 'Green Widget',
                'code' => 'G01',
                'price' => 24.95
            ],
            [
                'name' => 'Blue Widget',
                'code' => 'B01',
                'price' => 7.95
            ]
        ];

        foreach ($products as $product) {
            Product::updateOrCreate([
                'code' => $product['code']
            ], $product);
        }
    }
}