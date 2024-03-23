<?php

namespace App\Http\Controllers;

use App\Http\Services\Menu\MenuService;
use App\Http\Services\Product\ProductService;
use Illuminate\Http\Request;
use App\Http\Services\Slider\SliderService;

class MainController extends Controller
{
    protected $slider;
    protected $menu;
    protected $product;

    public function __construct(SliderService $slider, MenuService $menu, ProductService $product)
    {
        $this->slider = $slider;
        $this->menu = $menu;
        $this->product = $product;
    }
    public function index()
    {
        return view('main', [
            'title' => 'Shop Duy CR7',
            'sliders' => $this->slider->show(),
            'menus' => $this->menu->show(),
            'products' => $this->product->get()
        ]);
    }

    public function loadProduct(Request $request)
    {
        $page = $request->input('page', 0);

        $result = $this->product->get($page);

//        dd($result);
        if (count($result) != 0) {
            $html = view('product.list', ['products' => $result])->render();

            return response()->json([
                'html' => $html
            ]);
        }

        return response()->json(['html' => '']);
    }
}
