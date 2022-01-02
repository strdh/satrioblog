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
       \DB::beginTransaction();
       $file = FileHelper::upload($request->file('image'));
       $slider = Slider::create([
           'title' => $request->input('title'),
           'image' => $file["path"],
           'url' => $file["url"] ?? ''
       ]);
       \DB::commit();

       return $slider ? true : false;
   }

   public function update($request, $id)
   {
       $slider = Slider::findOrFail($id);
       $edit = [
           'title' => $request->input('title'),
       ];
       $new_image = $request->file('image_');
       if ($new_image) {
           Self::deleteImage('public/'.$slider->image);
           $file = FileHelper::upload($new_image);
           $edit["image"] = $file["path"];
           $edit["url"] = $file["url"] ?? '';
       }
       $slider->update($edit); 
   }

   public function del($id)
   {
       $slider = Slider::findOrFail($id);
       Self::deleteImage('public/'.$slider->image);
       $slider->delete();
       return;
   }

   public function deleteImage($url)
   {
       FileHelper::delete($url);
       return;
   }

   public function getSliders($request)
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