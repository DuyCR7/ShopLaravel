<?php

namespace App\Http\Services\Cart;

use App\Models\Customer;

class CartService
{
    public function getCustomer()
    {
        return Customer::query()->orderByDesc('id')->paginate(15);
    }

    public function getProductCart($customer)
    {
        return $customer->carts()->with('product')->get();
    }
}
