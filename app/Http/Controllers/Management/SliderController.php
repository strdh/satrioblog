<?php

namespace App\Http\Controllers\Management;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Slider;
use Facades\App\Repositories\Management\SliderRepository;


class SliderController extends Controller
{
   
    public function index()
    {
        $sliders = Slider::latest()->get();
        return view('management.slider.index', ['sliders' => $sliders]);
    }

    public function sliderTable(Request $request)
    {
        return SliderRepository::getSliders($request);
    }

    public function create()
    {
        return view('management.slider.create');
    }

    public function store(Request $request)
    {
        $request->validate(Slider::$rules);
        SliderRepository::store($request);
        return redirect(route('management.slider.create'));
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $slider = Slider::findOrFail($id);
        return view('management.slider.edit', ['slider' => $slider]);
    }

    public function update(Request $request, $id)
    {
        $request->validate(Slider::$rules);
        SliderRepository::update($request, $id);
        return redirect(route('management.slider.index'));
    }

    public function destroy($id)
    {
        SliderRepository::del($id);
        return redirect(route('management.slider.index'));
    }
}
