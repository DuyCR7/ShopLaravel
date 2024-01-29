<?php

namespace App\Http\Services\Product;

use App\Models\Menu;
use App\Models\Product;

class ProductAdminService
{
    public function getMenu()
    {
        return Menu::where('active', 1)->get();
    }

    protected function isValidPrice($request)
    {
        if($request->input('price') != 0 && $request->input('price_sale') != 0
           && $request->input('price_sale') >= $request->input('price')){
            $request->session()->flash('error', 'Giá khuyến mãi phải nhỏ hơn giá gốc!');
            return false;
        }

        if($request->input('price_sale') != 0 && (int)$request->input('price') == 0){
            $request->session()->flash('error', 'Vui lòng nhập giá gốc!');
            return false;
        }
        return true;
    }

    public function insert($request)
    {
        $isValidPrice = $this->isValidPrice($request);
        if($isValidPrice === false) return false;

//        dd($request->all());
        try {
            $request->except('_token');
            Product::create($request->all());

            $request->session()->flash('success', 'Thêm Sản Phẩm Thành Công');
        }catch (\Exception $err){
            $request->session()->flash('error', 'Thêm Sản Phẩm Không Thành Công!');
            \Log::info($err->getMessage());
            return false;
        }
        return true;
    }
}
