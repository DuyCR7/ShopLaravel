<?php

namespace App\Http\Services\Slider;

use App\Models\Slider;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class SliderService
{
    public function insert($request)
    {
        try {
            Slider::create($request->input()); //không cần except token vì chỉ lấy các cột trong model

            $request->session()->flash('success', 'Thêm Mới Slider Thành Công');
        } catch (\Exception $err) {
            $request->session()->flash('err', 'Thêm Mới Slider Không Thành Công');
            Log::info($err->getMessage());

            return false;
        }
        return true;
    }

    public function get()
    {
        return Slider::orderByDesc('id')->paginate(15);
    }

    public function update($request, $slider)
    {
        try {
            $slider->fill($request->input());
            $slider->save();

            $request->session()->flash('success', 'Cập Nhật Slider Thành Công');
        } catch (\Exception $err) {
            $request->session()->flash('error', 'Cập Nhật Slider Không Thành Công');
            Log::info($err->getMessage());

            return false;
        }

        return true;
    }

    public function destroy($request)
    {
        $slider = Slider::where('id', $request->input('id'))->first();
        if($slider){
            $path = str_replace('storage', 'public', $slider->thumb);
            Storage::delete($path); //xóa ảnh
            $slider->delete();
            return true;
        }

        return false;
    }

    public function show()
    {
        return Slider::query()->where('active', 1)->orderByDesc('sort_by')->get();
    }
}
