<?php

namespace App\Repositories\Management;
use Illuminate\Http\Request;
use App\Models\Slider;
use App\Helpers\FileHelper;
use DataTables;

class SliderRepository
{
   public function store($req)
   {
       \DB::beginTransaction();
       $file = FileHelper::upload($req->file('image'));
       $slider = Slider::create([
           'title' => $req->input('title'),
           'image' => $file["path"],
           'url' => $file["url"] ?? ''
       ]);
       \DB::commit();

       return $slider ? true : false;
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
                $action = '<form action={{"'. route('management.slider.destroy', $data->id) .'"}} onclick="return confirm('."'"."Yakin ?"."'".')"  method="POST">
                            "'.@csrf.'"
                            <input type="hidden" value="DELETE" name="_method">
                            <input type="submit" value="Del" class="btn btn-danger">
                            </form>';
                return $action;
            })
            ->rawColumns(['url', 'action'])
            ->make(true);
   }
}