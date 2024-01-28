<?php

namespace App\Http\Services\Menu;

use App\Models\Menu;
use Illuminate\Support\Str;
use MongoDB\Driver\Session;

class MenuService
{
    public function getParent()
    {
        return Menu::where('parent_id', 0)->get();
    }

    public function getAll()
    {
        return Menu::orderbyDesc('id')->paginate(10);
    }

    public function create($request)
    {
        try {
            Menu::create([
                'name' => (string) $request->input('name'),
                'parent_id' => (int) $request->input('parent_id'),
                'description' => (string) $request->input('description'),
                'content' => (string) $request->input('content'),
                'active' => (int) $request->input('active'),
                'slug' => Str::slug($request->input('name'), '-')
            ]);

            $request->session()->flash('success', 'Tạo Danh Mục Thành Công');
        } catch (\Exception $err) {
            $request->session()->flash('error', $err->getMessage());
            return false;
        }
        return true;
    }

    public function update($menu, $request) : bool
    {
//        $menu->fill($request->input());
//        $menu->save();
        // hoặc
        try {
            if($request->input('parent_id') != $menu->id){
                $menu->parent_id = (int) $request->input('parent_id');
            }

            $menu->name = (string) $request->input('name');
            $menu->description = (string) $request->input('description');
            $menu->content = (string) $request->input('content');
            $menu->active = (int) $request->input('active');
            $menu->slug = Str::slug($request->input('name'), '-');
            $menu->save();

            $request->session()->flash('success', 'Cập Nhật Danh Mục Thành Công');
        } catch (\Exception $err) {
            $request->session()->flash('error', $err->getMessage());
            return false;
        }
        return true;
    }

    public function destroy($request)
    {
        $id = (int) $request->input('id');

        $menu = Menu::where('id', $id)->first();
        if($menu){
            return Menu::where('id', $id)->orWhere('parent_id', $id)->delete();
        }
        return false;
    }
}
