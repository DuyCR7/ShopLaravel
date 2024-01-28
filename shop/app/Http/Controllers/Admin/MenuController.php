<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Menu\CreateFormRequest;
use App\Models\Menu;
use Illuminate\Http\Request;
use App\Http\Services\Menu\MenuService;


class MenuController extends Controller
{
    protected $menuService;

    public function __construct(MenuService $menuService)
    {
        $this->menuService = $menuService;
    }

    public function create()
    {
        return view('admin.menu.add', [
            'title' => 'Thêm Danh Mục Mới',
            'menus' => $this->menuService->getParent()
        ]);
    }
    public function store(CreateFormRequest $request)
    {
//        dd($request->input());
        $this->menuService->create($request);

        return redirect('/admin/menus/list');
    }

    public function index()
    {
        return view('admin.menu.list', [
            'title' => 'Danh Sách Danh Mục',
            'menus' => $this->menuService->getAll()
        ]);
    }

    public function show(Menu $menu)
    {
//        dd($menu);
        return view('admin.menu.edit', [
            'title' => 'Chỉnh Sửa Danh Mục: ' . $menu->name,
            'menu' => $menu,
            'menus' => $this->menuService->getParent()
        ]);
    }

    public function update(Menu $menu, CreateFormRequest $request)
    {
        $this->menuService->update($menu, $request);

        return redirect('/admin/menus/list');
    }

    public function destroy(Request $request): \Illuminate\Http\JsonResponse
    {
        $result = $this->menuService->destroy($request);
        if($result){
            return response()->json([
               'error' => false,
               'message' =>  'Xóa thành công danh mục',
            ]);
        }
        return response()->json([
            'error' => true
        ]);
    }
}
