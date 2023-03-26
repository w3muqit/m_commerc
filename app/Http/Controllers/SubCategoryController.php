<?php

namespace App\Http\Controllers;

use App\Models\category;
use App\Models\subcategory;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Str;
use Image;

class SubCategoryController extends Controller
{
    function subcategory(){
        $categories=category::all();
        $subcategory=subcategory::all();
        return view('admin.subcategory.subcategory',[
            'category'=>$categories,
            'subcategries'=>$subcategory,
        ]);
    }

    function add_subcategory(Request $request){
        $request->validate([
            'category_id'=>'required',
            'subcategory'=>'required',
            'subcategory_img'=>'required|file|max:512|mimes:jpg,bmp,png,webp',

        ]);

      $id= subcategory::insertGetId([
        'category_id'=>$request->category_id,
        'subcategory_name'=>$request->subcategory,
        'created_at'=>Carbon::now(),
       ]);

       $subcategory_img=$request->subcategory_img;
       $extension=$subcategory_img->GetClientOriginalExtension();
      $file_name= Str::random(3).rand(5,9).$id.'.'.$extension;
      $img = Image::make($subcategory_img)->resize(320, 240)->save(public_path('upload/subcategory/'.$file_name));

       subcategory::find($id)->update([
        'subcategory_image'=>$file_name,
       ]);
       return back();

    }

    function delete_subcategory($subcategory_id){
        subcategory::find($subcategory_id)->delete();
        return back();
    }


    function edit_subcategory($subcategory_id){
        $category=category::all();
        $subcategory=subcategory::find($subcategory_id);
        return view('admin.subcategory.edit_subcategory',[
            'categories'=>$category,
            'subcategories'=>$subcategory,
        ]);
    }

    function update_subcategory(Request $request){
        if($request->subcategory_img==''){
            subcategory::find($request->subcategory_id)->update([
                'category_id'=>$request->category_id,
                'subcategory_name'=>$request->subcategory_name,

            ]);
        }
        else{

            $image=subcategory::where('id',$request->subcategory_id)->first()->subcategory_image;
            $delete_from=public_path('upload/subcategory/'.$image);
            unlink($delete_from);

            $subcategory_img= $request->subcategory_img;
            $extension=$subcategory_img->GetClientOriginalExtension();
            $file_name=Str::random(8).rand(33,37).$request->subcategory_id.'.'.$extension;
            $img = Image::make($subcategory_img)->resize(320, 240)->save(public_path('upload/subcategory/'.$file_name));

            subcategory::find($request->subcategory_id)->update([
                'category_id'=>$request->category_id,
                'subcategory_name'=>$request->subcategory_name,
                'subcategory_image'=>$file_name,

            ]);

            return back();
        }
    }
}
