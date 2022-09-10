<?php

use App\Http\Controllers\CategoryController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\BrandController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AboutController;
use App\Http\Controllers\ContactController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/about', function () {
    return view('/about');
})->middleware('check');

Route::get('/home', function () {
    $brands = DB::table('brands')->latest()->get();
    $abouts = DB::table('home_abouts')->get();
    $about = $abouts->first();
    return view('home', compact('brands','about'));
});

Route::get('/contact', [Controller::class, 'index'])->name('con');

Route::get('/categories', [CategoryController::class, 'index'])->name('categories');

Route::post('/category/add', [CategoryController::class, 'AddCat'])->name('store.category');

Route::get('/category/edit/{id}', [CategoryController::class, 'Edit']);
Route::post('category/update/{id}', [CategoryController::class, 'Update']);

Route::get('/softdelete/category/{id}', [CategoryController::class, 'SoftDelete']);
Route::get('category/restore/{id}', [CategoryController::class, 'Restore']);
Route::get('category/pdelete/{id}', [CategoryController::class, 'PDelete']);

//Brands Routes
Route::get('/brands', [BrandController::class, 'AllBrands'])->name('all.brands');
Route::post('/brand/add', [BrandController::class, 'AddBrand'])->name('add.brand');
Route::get('/brand/edit/{id}', [BrandController::class, 'EditBrand']);
Route::post('/brand/update/{id}', [BrandController::class, 'UpdateBrand']);
Route::get('/brand/delete/{id}', [BrandController::class, 'DeleteBrand']);

//Login and logout
Route::get('/user/logout', [BrandController::class, 'Logout'])->name('user.logout');

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
    Route::get('/dashboard', function () {
        //$users = User::all();
       // $users = DB::table('users')->get();
        return view('admin/index');
    })->name('dashboard');
});

//Slider routes
Route::get('home/slider', [HomeController::class, 'HomeSlider'])->name('home.slider');
Route::get('home/slider/add', [HomeController::class, 'AddSlider'])->name('add.slider');
Route::post('home/slider/store', [HomeController::class, 'StoreSlider'])->name('store.slider');
Route::get('slider/edit/{id}', [HomeController::class, 'EditSlider']);
Route::post('/slider/update/{id}', [HomeController::class, 'UpdateSlider']);
Route::get('/slider/delete/{id}', [HomeController::class, 'DeleteSlider']);

//Home About
Route::get('/about', [AboutController::class, 'About'])->name('home.about');
Route::get('/about/edit/{id}', [AboutController::class, 'EditAbout']);
Route::post('/about/store', [AboutController::class, 'StoreAbout']);
Route::post('/about/update/{id}', [AboutController::class, 'UpdateAbout']);
Route::get('/about/delete/{id}', [AboutController::class, 'DeleteAbout']);

//Contact
Route::get('/contact', [ContactController::class, 'Contact'])->name('contact');
Route::post('/contact/store', [ContactController::class, 'AddContact']);
Route::get('/contact/edit/{id}', [ContactController::class, 'EditContact']);
Route::post('/contact/update/{id}', [ContactController::class, 'UpdateContact']);
Route::get('/contact/delete/{id}', [ContactController::class, 'DeleteContact']);
//Contact on Home Page
//Route::get('/contacts',[ContactController::class, 'HomeContact'])->name('contacts');
Route::get('/contacts', function () {
    $contact = DB::table('contacts')->first();
    return view('layouts.pages.contact', compact('contact'));
});
Route::post('contactform', [ContactController::class, 'StoreForm']);
Route::get('admin/message', [ContactController::class, 'AdminMessage'])->name('admin.message');
Route::get('message/delete/{id}', [ContactController::class, 'DeleteMessage']);
