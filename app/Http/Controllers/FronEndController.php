<?php

namespace App\Http\Controllers;

use App\Models\product;
use Illuminate\Http\Request;
use App\Models\Banner;
use App\Models\cart;
use App\Models\category;
use App\Models\coupon;
use App\Models\inventory;
use App\Models\size;
use App\Models\thumbnail;
use Str;
use Image;
use Illuminate\Support\Carbon;

class FronEndController extends Controller
{
    function welcome(){
        $product=product::all();
        $banner=banner::all();
        $categorys=category::all();
        return view('frontend.index',[
            'product'=>$product,
            'banner'=>$banner,
            'categorys'=>$categorys,
        ]);
    }

    function banner(){
        $banner=banner::all();
        return view('admin.banner.header.banner',[
            'banner'=>$banner,
        ]);
    }

    function add_banner(Request $request){
        $request->validate([
            'sub_title'=>'required',
            'title'=>'required',
            'desp'=>'required',
        ]);

     $banner_id = banner::insertGetId([
            'sub_title'=>$request->sub_title,
            'title'=>$request->title,
            'desp'=>$request->desp,
        ]);

        $banner_image=$request->img;
        $extension=$banner_image->getClientOriginalExtension();
        $file_name=Str::random(8).rand(5000,10000).'.'.$extension;
        $img = Image::make($banner_image)->save(public_path('upload/frontend/banner/'.$file_name));

        banner::find($banner_id)->update([
            'img'=>$file_name,
        ]);
        return back();

}

function single_product($slug){
    $product_info=product::where('slug',$slug)->get();
    $thumb_info=thumbnail::where('product_id',$product_info->first()->id)->get();
    $relete_product=product::where('category_id',$product_info->first()->category_id)->where('id','!=',$product_info->first()->id)->get();
    $available_color=inventory::where('product_id',$product_info->first()->id)->groupBy('color_id')->selectRaw('count(*) as total ,color_id')->get();
    $available_size=size::all();
    // $available_color=inventory::where('product_id',$product_info->first()->id)->groupBy('color_id')->selectRaw('count(*) as total, color_id')->get();
    // $available_size=inventory::where('product_id',$product_info->first()->id)->groupBy('size_id')->selectRaw('count(*) as total, size_id')->get();

    return view('frontend.view_product',[
        'product_info'=>$product_info,
        'thumb_info'=>$thumb_info,
        'relete_product'=>$relete_product,
        'available_color'=>$available_color,
        'available_size'=>$available_size,
        // 'available_colors'=>$available_color,
        // 'available_size'=>$available_size,
    ]);
}

    function customer(){
        return view('frontend.customer_register');
    }

    // function getcolorid(Request $request){
    //     $available_size=inventory::where('product_id',$request->product_id)->where('color_id',$request->color_id)->get();

    //     $str='';

    //     foreach( $available_size as $sizes){
    //         $str.='<div class="form-check size-option form-option form-check-inline mb-2">
    //         <input class="form-check-input" value="'.$sizes->rel_to_size->id .'" type="radio" name="size" id="'.$sizes->rel_to_size->id .'" checked="">
    //         <label class="form-option-label" for="'.$sizes->rel_to_size->id .'">'.$sizes->rel_to_size->size .'</label>
    //         </div>';
    //     }
    //     echo $str;


    // }

    function getsizeid(Request $request){
        $sizes=inventory::where('product_id',$request->product_id)->where('color_id',$request->color_id)->get();
        $str='';
        foreach ($sizes as $size){
            $str.='<div class="form-check size-option form-option form-check-inline mb-2">
            <input class="form-check-input" value="'.$size->rel_to_size->id.'" type="radio" name="size_id" id="'.$size->rel_to_size->id.'" >
            <label class="form-option-label" for="'.$size->rel_to_size->id.'">'.$size->rel_to_size->size.'</label>
            </div>';
        }

        echo $str;
    }

    function view_cart(Request $request){
        $coupon_table=coupon::where('coupon_name',$request->coupon)->get();
        // print_r($coupon_table);
        $discount= 0;
        $message= null ;
        $type='';

        if($request->coupon==''){
            $discount= 0;
           }
           else{
            if(coupon::where('coupon_name',$request->coupon)->exists()){
                if(Carbon::Now()->format('Y-m-d') > $coupon_table->first()->expire){
                    $discount= 0;
                    $message='Coupon Code Date Expire';
                }
                else{
                    $discount = $coupon_table->first()->discount;
                    $type = $coupon_table->first()->type;
                }
            }
            else{
                $discount= 0;
                $message='Invalid Coupon Code';
           }
        }
           return view('frontend.cart',[
            'message'=>$message,
            'discount'=>$discount,
            'coupon'=>$request->coupon,
            'type'=>$type,
           ]);
           print_r($request->all());    }

    function card_update(Request $request){
        $cart=$request->all();
        foreach($cart['quantity'] as $cart_id=>$quantity){
           cart::find($cart_id)->update([
            'quantity'=>$quantity,
           ]);
        }
        return back();

    }



}

