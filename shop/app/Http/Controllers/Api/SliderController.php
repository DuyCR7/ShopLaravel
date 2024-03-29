<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Services\Slider\SliderService;
use App\Models\Slider;
use Illuminate\Http\Request;


class SliderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    protected $slider;

    public function __construct(SliderService $slider)
    {
        $this->slider = $slider;
    }
    public function create()
    {
        return view('admin.slider.testApiAdd', [
            'title' => 'Thêm mới Slider'
        ]);
    }
    public function index()
    {
        //
        $sliders = Slider::all();
        return view('admin.slider.testApiList', [
            'title' => 'Danh Sách Slider Mới Nhất',
            'sliders' => $sliders
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        Slider::create($request->input());
        return redirect('admin.slider.testApiList');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Slider $slider)
    {
        //
        return view('admin.slider.testApiEdit', [
            'title' => 'Cap Nhat',
            'slider' => $slider
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Slider $slider)
    {
        //
        $this->validate($request, [
            'name' => 'required',
            'thumb' => 'required',
            'url' => 'required'
        ]);

        $result = $this->slider->update($request, $slider);
        if($result) {
            return redirect('/api/sliders');
        }

        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Slider $slider)
    {
        //
        $slider->delete();
    }
}
