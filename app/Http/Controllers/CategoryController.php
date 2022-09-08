<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Carbon;

class CategoryController extends Controller
{

    public function __construct(){
        $this->middleware('auth');
    }

    public function index(){
        /*$categories = DB::table('categories')
        ->join('users', 'categories.user_id', 'users.id')
        ->select('categories.*', 'users.name')
        ->latest()->paginate(5);*/

        $categories = Category::latest()->paginate(5);
        $trashCat = Category::onlyTrashed()->latest()->paginate(3);

        //$categories = DB::table('categories')->latest()->paginate(5);
        return view('admin.category.index', compact('categories','trashCat'));
    }

    public function Edit($id){
        //$category = Category::findOrFail($id);
        $category = DB::table('categories')->where('id', $id)->first();
        return view('admin/category/edit', compact('category'));
    }

    public function AddCat(Request $request){

        $validateData = $request->validate([
            'category_name' => 'required'
        ]
    );



   /* Category::insert([
        'category_name' => $request->category_name,
        'user_Id' => Auth::user()->id,
        'created_at' => $request->created_at,
    ]); */

    /*$category = new Category;
    $category->category_name = $request->category_name;
    $category->user_Id = Auth::user()->id;
    $category->created_at = Carbon::now();
    $category->save(); */

    $data = array();
    $data['category_name'] = $request->category_name;
    $data['user_id'] = Auth::user()->id;
    $data['created_at'] = $request->created_at;
    DB::table('categories')->insert($data);

    return redirect()->back()->with('success','Category inserted successfully');
}

public function Update(Request $request, $id){
    /*$update = Category::findOrFail($id)->update([
        'category_name' => $request->category_name,
        'user_id' => Auth::user()->id
    ]);*/

    $update = DB::table('categories')->where('id',$id)
->update([
    'category_name' => $request->category_name,
    'user_id' => Auth::user()->id
]);

return redirect()->route('categories')->with('success', 'Category name update successfully');
}

public function SoftDelete($id){
$delete = Category::find($id)->delete();
return redirect()->back()->with('success','Soft Deleted Successfully');
}

public function Restore($id){
    $restore=Category::withTrashed()->find($id)->restore();
    return redirect()->back()->with('success','Restored Successfully');
}

public function PDelete($id){
    $delete=Category::onlyTrashed()->find($id)->forceDelete();
    return redirect()->back()->with('success','Deleted Permanently');
}

}
