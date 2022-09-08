<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Models\Brand;
use Illuminate\Support\Facades\Auth;

class BrandController extends Controller
{

    public function __construct(){
        $this->middleware('auth');
    }

    public function AllBrands(){
        $brands = DB::table('brands')->latest()->paginate(5);
        return view('admin.brand.index', compact('brands'));
    }

    public function AddBrand(Request $request){
        $validateBrand = $request->validate([
            'brand_name' => 'required',
            'brand_image' => 'required|mimes:jpg,jpeg,png'
        ]);

        $brand_image = $request->file('brand_image');
        //$name_gen = hexdec(uniqid());
        $name_gen = hexdec(uniqid());
        $img_ext = strtolower($brand_image->getClientOriginalExtension());
        $img_name = $name_gen.'.'.$img_ext;
        $up_location = 'image/brand/';
        $last_img = $up_location.$img_name;
        $brand_image->move($up_location,$img_name);

        $brand = DB::table('brands')->insert([
            'brand_name' => $request->brand_name,
            'brand_image' => $last_img,
            'created_at' => Carbon::now()
        ]);
        return redirect()->back()->with('success','Brand added successfully');
    }

    public function EditBrand($id){
        $brand = DB::table('brands')->find($id);
        return view('admin.brand.edit', compact('brand'));
    }

    public function UpdateBrand(Request $request,$id){

        $validateBrand = $request->validate([
            'brand_name' => 'required'

        ]);

        $old_image = $request->old_image;

        $brand_image = $request->file('brand_image');

        if($brand_image){

        $name_gen = hexdec(uniqid());
        $img_ext = strtolower($brand_image->getClientOriginalExtension());
        $img_name = $name_gen.'.'.$img_ext;
        $up_location = 'image/brand/';
        $last_img = $up_location.$img_name;
        $brand_image->move($up_location,$img_name);

        unlink($old_image);


        Brand::find($id)->update([
            'brand_name' => $request->brand_name,
            'brand_image' => $last_img,
            'created_at' => Carbon::now()
        ]);
        return redirect()->back()->with('success','Brand updated successfully');

        }else{

            Brand::find($id)->update([
                'brand_name' => $request->brand_name,
                'created_at' => Carbon::now()
            ]);
            return redirect('/brands')->with('success','Brand updated successfully');

        }

    }

    public function DeleteBrand($id){
    $brand = Brand::find($id);
    $old_image = $brand->brand_image;
    unlink($old_image);

    Brand::find($id)->delete();

        return redirect('/brands')->with('success','Brand deleted successfully');
    }

    public function Logout(){
        Auth::logout();
        return Redirect()->route('login')->with('success', 'Logged out successfully');
    }
}
