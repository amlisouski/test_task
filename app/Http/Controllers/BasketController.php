<?php

namespace App\Http\Controllers;

use App\Models\Basket;
use App\Models\Product;

class BasketController extends Controller
{

    public function index()
    {
        return view('basket.index', [
            'products' => Product::all()
        ]);
    }


    public function store($code)
    {
        $basketProducts = [];
        $product = Product::getByCode($code);
        $basket = Basket::all()->pop();

        if ($basket !== null) {
            $basketProducts = $basket->products;
        }

        if (isset($basketProducts[$product->id])) {
            $basketProducts[$product->id]['qty'] += 1;
        } else {
            $basketProducts[$product->id] = [
                'qty' => 1,
                'price' => $product->price
            ];
        }

        Basket::updateOrCreate([
            'id' => $basket?->id,
        ], [
            'products' => $basketProducts
        ]);

        return redirect(route('basket.total'));
    }

    public function destroy($code)
    {
        $product = Product::getByCode($code);
        $basket = Basket::all()->pop();
        $products = $basket->products;
        unset($products[$product->id]);
        $basket->update([
            'products' => $products
        ]);

        return redirect(route('basket.total'));
    }

    public function total()
    {
        $basket = Basket::all()->pop();
        return view('basket.total', [
            'basket' => $basket,
            'costs' => $basket?->calculate()
        ]);
    }
}