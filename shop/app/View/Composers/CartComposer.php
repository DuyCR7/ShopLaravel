<?php

namespace App\View\Composers;
use App\Models\Product;
use Illuminate\Support\Facades\Session;
use Illuminate\View\View;

class CartComposer
{
    /**
     * Create a new profile composer.
     */
    protected  $users;
    public function __construct() {

    }

    /**
     * Bind data to the view.
     */
    public function compose(View $view)
    {
        $carts = Session::get('carts');
//        dd($carts);
        if (is_null($carts))
        {
            return [];
        }

        $productId = array_keys($carts);
        $products =  Product::query()->select('id', 'name', 'price', 'price_sale', 'thumb')
            ->where('active', 1)
            ->whereIn('id', $productId)
            ->get();

        $view->with([
            'products' => $products,
            'carts' => $carts
        ]);
    }
}
