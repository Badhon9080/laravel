<?php
//use App\Http\Controllers\FrontendController;
//use App\Http\Controllers\UserController;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BacKend\BacKendController;
use App\Http\Controllers\Category\CategoryController;
use App\Http\Controllers\Frontend\FrontendController;


//use App\Http\Controllers\FrontendController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/
/*
Route::get('/', function () {
    return view('welcome');
});
*/
/*
Route::get('/', function(){
    echo "Home";
});



Route::get('/about', function(){
    echo "About US";
});
*/
//Route::get('/', [FrontendController::class, 'homepage'])->name('landing-page');
//Route::get('/about-us', [FrontendController::class, 'aboutUs'])->name('about');
//Route::get('/portfolio', [FrontendController::class, 'portfolio'])->name('portfolio');
//Route::get('/service', [FrontendController::class, 'service'])->name('service');

//Route::get('/user', [UserController::class, 'getUser']);
//Route::get('/user/{name}', [UserController::class, 'getUser']);
//Route::get('/user/{id}', [UserController::class, 'getUser']);
//Route::get('/user/{name}', [FrontendController::class, 'getUser'])->name('user');
//Route::get('/students/{name}/{rolls?}', [FrontendController::class, 'getStudents'])->name('students');




Auth::routes();




Route::get('/', [FrontendController::class,'home'])->name('home');
Route::get('/dashboard',[BacKendController::class,'dashboard'])->name('dashboard')->middleware('auth');
Route::get('/admin/category',[CategoryController::class,'category'])->name('category')->middleware('auth');
Route::post('/admin/category',[CategoryController::class,'store'])->name('store')->middleware('auth');
Route::get('/admin/edit/{id}',[CategoryController::class,'edit'])->name('edit')->middleware('auth');
Route::put('/admin/update{id}',[CategoryController::class,'update'])->name('update')->middleware('auth');
Route::get('/admin/delete{id}',[CategoryController::class,'delete'])->name('delete')->middleware('auth');