<?php

namespace App\Http\Controllers;
use App\Models\Slider;

use Illuminate\Http\Request;

class HomeController extends Controller
{
 public function HomeSlider(){
    $sliders = Slider::all();
    return view('admin.slider.index', compact('sliders'));
 }

 public function AddSlider(){
   return view('admin.slider.add');
    }

public function StoreSlider(Request $request){

    $validateSlider = $request->validate([
        'title' => 'required',
        'image' => 'required|mimes:jpg,jpeg,png'
    ]);

    $image = $request->file('image');
        $name_gen = hexdec(uniqid());
        $img_ext = strtolower($image->getClientOriginalExtension());
        $img_name = $name_gen.'.'.$img_ext;
        $up_location = 'image/sliders/';
        $last_img = $up_location.$img_name;
        $image->move($up_location,$img_name);

    $slider = Slider::insert([
        'title' => $request->title,
        'description' => $request->description,
        'image' => $last_img
    ]);

    return redirect()->route('home.slider')->with('success','Inserted seccessfully');

    }

    public function EditSlider($id){
        $slider = Slider::find($id);
        return view('admin.slider.edit', compact('slider'));
    }

    public function UpdateSlider(Request $request, $id){
        $slider = Slider::find($id);

        $validateSlider = $request->validate([
            'title' => 'required',
            'description' => 'required'

        ]);

        $image = $request->file('image');
        $name_gen = hexdec(uniqid());
        $img_ext = strtolower($image->getClientOriginalExtension());
        $img_name = $name_gen.'.'.$img_ext;
        $up_location = 'image/slider/';
        $last_img = $up_location.$img_name;
        $image->move($up_location,$img_name);

        $slider = Slider::find($id)->update([
            'title' => $slider->title,
            'image' => $last_img,
            'description' => $slider->description
        ]);

        return redirect()->back()->with('success','Updated successfully');
    }

    public function DeleteSlider($id){
        $slider = Slider::find($id)->delete($id);
        return redirect()->back()->with('success','Deleted successfully');
    }
}
