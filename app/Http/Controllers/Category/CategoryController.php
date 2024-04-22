<?php

namespace App\Http\Controllers\Category;

use App\Helpers\MediaUploader;
use App\Helpers\Sluggenerator;
use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CategoryController extends Controller{use Sluggenerator, MediaUploader;
    public function category(){
        $categorys = Category::with('subcategories')->latest()->paginate(30);
        $parentCategories =  $categorys->where('category_id',null)->flatten();
        dd($categorys);
        //    return view("bend.Category.category",compact("categorys","parentCategories"));
    }
    //Store
    public function store(Request $request)
    {

        $request->validate([
           'icon'=> "mimes:png,jpg",
       ]);

        //image name ->Slug

        $slug=$this->createSlug(Category::class,$request->category);
        if($request->hasFile('icon')){
    $iconPath = $this->uploadSingleMedia($request->icon,$slug,"category");
        }
        $categoryStore =   new Category();
        $categoryStore->category = $request->category;
        $categoryStore->category_slug = $slug;
        $categoryStore->icon = $request->hasFile('icon') ? $iconPath : null;
        $categoryStore->category_id = $request->category_id;
        $categoryStore->save();return back();
    }
    //edit
    public function edit($id){
        $categorys = Category::with('subcategories')->latest()->paginate(30);
        $parentCategories =  $categorys->where('category_id',null)->flatten();
        $findCategory= $categorys->where('id',$id)->first();
          return view("bend.Category.category",compact("categorys","findCategory","parentCategories"));
        }
        //update
        public function update(Request $request,$id){
            $slug=$this->createSlug(Category::class,$request->category);
            if($request->hasFile('icon')){
        $iconPath = $this->uploadSingleMedia($request->icon,$slug,"category",$request->old);
            }
            $categoryStore =    Category::find($id);
            $categoryStore->category = $request->category;
            $categoryStore->category_slug = $slug;
            $categoryStore->icon = $request->hasFile('icon') ? $iconPath : null;
            $categoryStore->category_id = $request->category_id;
            $categoryStore->save();return back();
        }
    //delete
    public function delete($id){
        Category::find($id)->delete();return back();
    }
}