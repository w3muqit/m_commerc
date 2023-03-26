<?php

namespace App\Http\Controllers;

use App\Models\category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Carbon;
use Str;
use Image;

class CategoryController extends Controller
{
    function category(){
        $categories=category::all();
        $trashed=category::onlyTrashed()->get();
        return view('admin.category.category',[
            'category'=>$categories,
            'trashed'=>$trashed,
        ]);
    }

    function Add_category(Request $request){
        $request->validate([
            'category_name'=>'required',
            'category_img'=>'file|max:512|mimes:jpg,bmp,png,webp'
        ]);

        if($request->category_img==''){
            $id=  category::insertGetId([
                'category_name'=>$request->category_name,
                'icon'=>$request->icon,
                'added_by'=>Auth::id(),
                'created_at'=>Carbon::now(),
            ]);
            return back();
        }

        else{

            $id=  category::insertGetId([
                'category_name'=>$request->category_name,
                'icon'=>$request->icon,
                'added_by'=>Auth::id(),
                'created_at'=>Carbon::now(),
            ]);

            $category_img=$request->category_img;
        $extension=$category_img->GetClientOriginalExtension();
        $file_name=Str::random(10).rand(21,28).$id.'.'.$extension;
        $img = Image::make($category_img)->resize(320, 240)->save(public_path('upload/category/'.$file_name));

        category::find($id)->update([
            'category_image'=>$file_name,
        ]);
        return back();


        }




    }

    function edit_category ($category_id){
       $category= category::find($category_id);
        return view('admin.category.edit_category',[
            'categories'=>$category,
        ]);
    }


    function update_category(Request $request){
            if($request->cateory_image==''){
                category::find($request->category_id)->update([
                    'category_name'=>$request->cateory_name,
                ]);
                return back();
            }
            else{

                $img=category::where('id',$request->category_id)->first()->category_image;
                $delete_from=public_path('upload/category/'.$img);
                unlink($delete_from);

                $category_img=$request->cateory_image;
                $extension=$category_img->GetClientOriginalExtension();
                $file_name=Str::random(10).rand(21,28).$request->category_id.'.'.$extension;
                $img = Image::make($category_img)->resize(320, 240)->save(public_path('upload/category/'.$file_name));

                category::find($request->category_id)->update([
                    'category_name'=>$request->cateory_name,
                    'category_image'=>$file_name,
                ]);
                return back();

            }
    }

    function delete_category($category_id){
        category::where('id',$category_id)->delete();
        return back();
    }



    function restopre_category($category_id){
        category::onlyTrashed()->where('id',$category_id)->restore();
        return back();
    }

    function hard_delete_category($category_id){
         $img=category::onlyTrashed()->where('id',$category_id)->first()->category_image;
        $delete_from=public_path('upload/category/'.$img);
        unlink($delete_from);

        category::onlyTrashed()->where('id',$category_id)->forceDelete();
    }
}
