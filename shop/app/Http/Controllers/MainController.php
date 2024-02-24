<?php

namespace App\Http\Controllers;

use App\Http\Services\Menu\MenuService;
use Illuminate\Http\Request;
use App\Http\Services\Slider\SliderService;

class MainController extends Controller
{
    protected $slider;
    protected $menu;

    public function __construct(SliderService $slider, MenuService $menu)
    {
        $this->slider = $slider;
        $this->menu = $menu;
    }
    public function index()
    {
        return view('main', [
            'title' => 'Shop Duy CR7',
            'sliders' => $this->slider->show(),
            'menus' => $this->menu->show()
        ]);
    }
}
