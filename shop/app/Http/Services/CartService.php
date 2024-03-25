<?php

namespace App\Http\Services;

use App\Models\Product;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Session;


class CartService
{
    public function create($request)
    {
        $qty = (int)$request->input('num-product');
        $product_id = (int)$request->input('product_id');

        if ($qty <= 0 || $product_id <= 0)
        {
            $request->session()->flash('error', 'Số lượng hoặc Sản phẩm không chính xác!');
            return false;
        }
//        Session::forget('carts');

        $carts = Session::get('carts');

        if (is_null($carts))
        {
            Session::put('carts', [
                $product_id => $qty
            ]);
            return true;
        }

        $exists = Arr::exists($carts, $product_id);
        if ($exists)
        {
            $carts[$product_id] = $carts[$product_id] + $qty;

            Session::put('carts', $carts);
            return true;
        }

        $carts[$product_id] = $qty;
        Session::put('carts', $carts);
        return true;

    }

    public function getProduct()
    {
        $carts = Session::get('carts');
        if (is_null($carts))
        {
            return [];
        }

        $productId = array_keys($carts);
        return Product::query()->select('id', 'name', 'price', 'price_sale', 'thumb')
            ->where('active', 1)
            ->whereIn('id', $productId)
            ->get();
    }

    public function update($request)
    {
        Session::put('carts', $request->input('num-product'));

        return true;
    }

    public function remove($id)
    {
        $carts = Session::get('carts');
//        dd($carts);
        unset($carts[$id]);

        Session::put('carts', $carts);
        return true;
    }

}
