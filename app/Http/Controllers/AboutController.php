<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\HomeAbout;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;

class AboutController extends Controller
{
    public function About(){
        $abouts = DB::table('home_abouts')->latest()->paginate(5);
        return view('admin.body.about.index', compact('abouts'));
    }

    public function EditAbout($id){
        $about = DB::table('home_abouts')->find($id);
        return view('admin.body.about.edit', compact('about'));
    }

    public function StoreAbout(Request $request){
        $validate = $request->validate([
            'title' => 'required',
            'description' => 'required'

        ]);

        HomeAbout::insert([
            'title' => $request->title,
            'description' => $request->description,
            'long_description' => $request->long_description,
            'created_at' => Carbon::now()
        ]);

        return redirect()->back()->with('success','Insertedd Inserted successfully');
    }

    public function UpdateAbout(Request $request,$id){

        $about = HomeAbout::find($id);
       //$about = DB::table('home_abouts')->find($id);

        $validate = $request->validate([
            'title' => 'required',
            'description' => 'required'
        ]);

        DB::table('home_abouts')->update([
            'title' => $request->title,
            'description' => $request->description,
            'long_description' => $request->long_description
        ]);
       return redirect()->back()->with('success','About inserted About successfully');

    }

    public function DeleteAbout($id){
        $about = HomeAbout::find($id);
        $about->delete();
        return redirect()->back()->with('success',' Deleted About Deleted About Successfully');
    }
}
