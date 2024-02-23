<?php

namespace App\Http\Controllers;

use App\Http\Services\Menu\MenuService;
use Illuminate\Http\Request;

class MainController extends Controller
{
    protected $menu;

    public function __construct(MenuService $menu)
    {
        $this->menu = $menu;
    }
    public function index()
    {
        return view('main', [
            'title' => 'Shop Duy CR7',
            'menus' => $this->menu->show()
        ]);
    }
}
