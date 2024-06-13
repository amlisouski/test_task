<?php

namespace Database\Seeders;


use App\Models\Order\Delivery;
use Illuminate\Database\Seeder;

class OrderDeliveriesSeeder extends Seeder
{
    public function run()
    {
        $deliveries = [
            [
                'threshold' => 0,
                'amount' => 4.95
            ],
            [
                'threshold' => 50,
                'amount' => 2.95
            ],
            [
                'threshold' => 90,
                'amount' => 0
            ]
        ];

        foreach ($deliveries as $delivery) {
            Delivery::updateOrCreate([
                'threshold' => $delivery['threshold']
            ], [
                'amount' => $delivery['amount']
            ]);
        }
    }
}