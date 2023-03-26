<?php

namespace App\Http\Controllers;

use App\Models\category;
use App\Models\color;
use App\Models\inventory;
use App\Models\product;
use App\Models\size;
use App\Models\subcategory;
use App\Models\thumbnail;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Str;
use Image;

class ProductController extends Controller
{
    function product(){
        $category=category::all();
        return view('admin.product.product',[
            'categories'=>$category,
        ]);
    }

    function getsubcategory(Request $request){
        $getsubcategory=subcategory::where('category_id',$request->category_id)->get();
        $str='<option value="">--Select Category--</option>';

        foreach( $getsubcategory as $getsubcategory){
            $str.='<option value="'.$getsubcategory->id.'">'.$getsubcategory->subcategory_name.'</option>';
        }
        echo $str;

    }

    function add_product(Request $request){
        //ismail vai code //
    // function add_product(Request $request){
    //     if ($request->hasFile('thumbnails')) {
    //         $files =$request->thumbnails;
    //         $data = null;
    //         foreach($files as $file){
    //             $make = $file;
    //                 $extn = $make->getClientOriginalExtension();
    //                 $profileName = 'PRO'.rand(1,2000).'FILE'.rand(1,500).'.'. $extn;
    //                 $data .= $profileName;
    //                 Image::make($make)->save(public_path('upload/product/thumbnail/'.$profileName));

    //                 thumbnail::insert([
    //                     'thumbnail'=>$profileName,
    //                     'created_at'=>Carbon::now(),
    //                 ]);
    //         }
    //         return $data;
    //     } 

    // --------END------//data;

       $id= product::insertGetId([
            'category_id'=>$request->category_id,
            'subcategory_id'=>$request->subcategory_id,
            'product_name'=>$request->product_name,
            'product_price'=>$request->product_price,
            'discount'=>$request->discount,
            'after_discount'=>$request->product_price -($request->product_price*$request->discount/100),
            'brand'=>$request->brand,
            'short_desp'=>$request->short_desp,
            'long_desp'=>$request->long_desp,
            'slug'=>Str::lower(str_replace(' ','-',$request->product_name).rand(100,9000)),
            'created_at'=>Carbon::now(),
        ]);

        $brand_img=$request->brand_img;
        $extension=$brand_img->getClientOriginalExtension();
        $file_name=Str::random(8).rand(99,999).$id.'.'.$extension;
        $img = Image::make($brand_img)->resize(320, 240)->save(public_path('upload/product/brand/'.$file_name));

        product::find($id)->update([
            'brand_img'=>$file_name,
        ]);

        $product_img=$request->preview;
        $extension=$product_img->getClientOriginalExtension();
        $file_name=Str::random(8).rand(99,999).$id.'.'.$extension;
        $img = Image::make($product_img)->resize(320, 240)->save(public_path('upload/product/preview/'.$file_name));

        product::find($id)->update([
            'preview'=>$file_name,
        ]);

        // $thumbnail = $request->thumbnails;

        foreach( $request->thumbnails as $thumb){
            $extension=$thumb->getClientOriginalExtension();
            $file_name=Str::random(10).rand(10000,100000).'.'.$extension;

            $image = Image::make($thumb)->resize(300, 200)->save(public_path('upload/product/thumbnail/'.$file_name));

            thumbnail::insert([
                'product_id'=>$id,
                'thumbnail'=>$file_name,
            ]);
           }

            return back();

        }

        function view_product(){
            $products=product::all();
            return view('admin.product.view_product',[
                'product'=>$products,
            ]);
        }

        function variation(){
            $colors=color::all();
            $sizes=size::all();
            return view('admin.product.variation.variation',[
                'colors'=>$colors,
                'sizes'=>$sizes,
            ]);
        }

        function add_variation(Request $request){
            if($request->btn==1){
                $request->validate([
                    'color_name'=>'required',
                ]);
            }
            else{
                $request->validate([
                    'size'=>'required',
                ]);
            }
            if($request->btn==1){
                color::insert([
                    'color_name'=>$request->color_name,
                    'color_code'=>$request->color_code,
                ]);
                return back();
            }
            else{
                size::insert([
                    'size'=>$request->size,
                ]);
                return back();
            }
        }

        function edit_color($color_id){
            $color=color::find($color_id);
            return view('admin.product.variation.edit_color',[
                'color'=>$color,
            ]);
        }

        function update_color(Request $request){
            color::where('id',$request->color_id)->update([
                'color_name'=>$request->color_name,
                'color_code'=>$request->color_code,
            ]);
            return back();
        }

        function delete_color($color_id){
            color::find($color_id)->delete();
            return back();
        }

        function edit_size($size_id){
            $size=size::find($size_id);
            return view('admin.product.variation.edit_size',[
                'size'=>$size,
            ]);
        }

        function update_size(Request $request){
            size::where('id',$request->size_id)->update([
                'size'=>$request->size,
            ]);
            return back();
        }

        function size_color($size_id){
            size::find($size_id)->delete();
            return back();
        }

        function inventory($product_id){
            $product_info=product::find($product_id);
            $inventory=inventory::where('product_id',$product_id)->get();
            $colors=color::all();
            $sizes=size::all();
            return view('admin.product.inventory.inventory',[
                'product_info'=>$product_info,
                'inventory'=>$inventory,
                'colors'=>$colors,
                'sizes'=>$sizes,
            ]);
        }

        function add_inventory(Request $request){
        inventory::insert([
            'product_id'=>$request->product_id,
            'quantity'=>$request->quantity,
            'color_id'=>$request->color_id,
            'size_id'=>$request->size_id,
        ]);
        return back();

        }

        function delete_inventory($inventory_id){
            inventory::find($inventory_id)->delete();
            return back();
        }

        function delete_product($product_id){
            $product_image=product::where('id',$product_id)->first()->preview;
            $delete_from=public_path('upload/product/preview/').$product_image;
            unlink($delete_from);

            $thumbnail=thumbnail::where('product_id',$product_id)->get();
            foreach($thumbnail as $thumb){
             $delete_thumb=thumbnail::where('id',$thumb->id)->first()->thumbnail;
            $delete_from_thumb=public_path('upload/product/thumbnail/').$delete_thumb;
            unlink($delete_from_thumb);
            thumbnail::find($thumb->id)->delete();
            }

            product::find($product_id)->delete();
            return back();

        }
}
