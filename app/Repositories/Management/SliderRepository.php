<?php

namespace App\Repositories\Management;
use Illuminate\Http\Request;
use App\Models\Slider;
use App\Helpers\FileHelper;
use DataTables;

class SliderRepository
{
   public function store($request)
   {
       $file = FileHelper::upload($request->file('image'));
       $slider = Slider::create([
           'title' => $request->input('title'),
           'image' => $file["path"],
           'url' => $file["url"] ?? ''
       ]);
       
       return $slider ? true : false;
   }

   public function update($request, $id)
   {
       $slider = Slider::findOrFail($id);
       $data = [
           'title' => $request->input('title'),
       ];
       $new_image = $request->file('image');
       if ($new_image) {
           FileHelper::delete('public/'.$slider->image);
           $file = FileHelper::upload($new_image);
           $data["image"] = $file["path"];
           $data["url"] = $file["url"] ?? '';
       }
       $slider = $slider->update($data); 
       return $slider ? true : false;
   }

   public function del($id)
   {
       $slider = Slider::findOrFail($id);
       FileHelper::delete('public/'.$slider->image);
       $slider->delete();
       return;
   }

   public function getSlider($request)
   {
       $data = Slider::latest()->get();
       return Datatables::of($data)
            ->editColumn("created_at", function($data) {
                return date('m/d/Y', strtotime($data->created_at));
            })
            ->editColumn("url", function($data) {
                $img = '<img src="'.$data->url.'" width="70" height="70">';
                return $img;
            })
            ->addColumn('action', function ($data) {
                $action =  '<div class="row g-3 align-items-center">
                                <div class="col-auto">
                                    <a href="'.route('management.slider.edit', $data->id).'" class="btn btn-primary">Edit</a>
                                </div>
                                <div class="col-auto">
                                    <form class="" action="'.route('management.slider.destroy', $data->id).'" onclick="return confirm('."'"."Yakin ?"."'".')"  method="POST">
                                        '.csrf_field().''.method_field("DELETE").'
                                        <input type="hidden" value="DELETE" name="_method">
                                        <input type="submit" value="Del" class="btn btn-danger">
                                    </form>
                                </div>
                            </div>';
                return $action;
            })
            ->rawColumns(['url', 'action'])
            ->make(true);
   }
}