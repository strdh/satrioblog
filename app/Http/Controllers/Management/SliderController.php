<?php

namespace App\Http\Controllers\Management;

use App\Http\Controllers\Controller;
use App\Http\Requests\Management\SliderRequest;
use Illuminate\Http\Request;
use App\Models\Slider;
use Facades\App\Repositories\Management\SliderRepository;


class SliderController extends Controller
{
   
    public function index()
    {
        return view('management.slider.index');
    }

    public function sliderTable(Request $request)
    {
        return SliderRepository::getSlider($request);
    }

    public function create()
    {
        return view('management.slider.create');
    }

    public function store(SliderRequest $request)
    {
        SliderRepository::store($request);
        return redirect(route('management.slider.create'))->with('success', 'Slider berhasil ditambahkan');
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

    public function update(SliderRequest $request, $id)
    {
        SliderRepository::update($request, $id);
        return redirect(route('management.slider.index'))->with('success', 'Slider berhasil diupdate');
    }

    public function destroy($id)
    {
        SliderRepository::del($id);
        return redirect(route('management.slider.index'))->with('warning', 'Slider berhasil dihapus');
    }
}
