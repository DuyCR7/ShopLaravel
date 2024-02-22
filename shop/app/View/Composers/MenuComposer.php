<?php

namespace App\View\Composers;
use App\Models\Menu;
use Illuminate\View\View;

class MenuComposer
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
        $menu = Menu::select('id', 'name', 'parent_id')->where('active', 1)->orderByDesc('id')->get();

        $view->with('menus', $menu);
    }
}
