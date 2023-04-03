<?php

namespace App\Http\Controllers;

use App\Mail\invoicemail;
use App\Models\billingdetails;
use App\Models\cart;
use App\Models\city;
use App\Models\country;
use App\Models\customerlogin;
use App\Models\inventory;
use App\Models\order;
use App\Models\order_details;
use Carbon\Carbon;
use GrahamCampbell\ResultType\Success;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Str;
use Illuminate\Support\Facades\Mail;



class checkoutcontroller extends Controller
{
    function checkout(){
        $cart_item=cart::where('customer_id',Auth::guard('customerlogin')->id())->get();
        $user_info=customerlogin::where('id',Auth::guard('customerlogin')->id())->get();
        $country= country::all();
        return view('frontend.checkout',[
            'cart_item'=>$cart_item,
            'user_info'=>$user_info,
            'country'=>$country,
        ]);
    }
    function getcityid(Request $request){
        $city= city::where('country_id',$request->city_id)->get();
        $str ='<option value="">-- Select Country --</option>';
        foreach($city as $city_id){
            $str.='<option value="'.$city_id->id.'">'.$city_id->name.'</option>';
        }
        echo $str;
    }

    function checkout_store(Request $request){
        $order_id='#'.'-'.Str::random(3).rand(555555555,6666666);
        if($request->payment_method==1){
                    // order store//
        order::insert([
            'order_id'=>$order_id,
            'customer_id'=>Auth::guard('customerlogin')->id(),
            'sub_total'=>$request->sub_total,
            'total'=>$request->sub_total+$request->charge,
            'discount'=>$request->discount,
            'charge'=>$request->charge,
            'payment_method'=>$request->payment_method,
            'created_at'=>Carbon::Now(),
        ]);

        // billing //
        billingdetails::insert([
            'order_id'=>$order_id,
            'customer_id'=>Auth::guard('customerlogin')->id(),
            'name'=>$request->name,
            'email'=>$request->email,
            'company'=>$request->company,
            'mobile'=>$request->mobile,
            'address'=>$request->address,
            'country_id'=>$request->country_id,
            'city_id'=>$request->city_id,
            'zip'=>$request->zip,
            'nots'=>$request->notes,
            'created_at'=>Carbon::now(),
        ]);
        // order_details //
        $cart=cart::where('customer_id',Auth::guard('customerlogin')->id())->get();
        foreach( $cart as $carts){
            order_details::insert([
                'order_id'=>$order_id,
                'customer_id'=>Auth::guard('customerlogin')->id(),
                'product_id'=>$carts->product_id,
                'price'=>$carts->rel_to_pro->after_discount,
                'color_id'=>$carts->color_id,
                'size_id'=>$carts->size_id,
                'quantity'=>$carts->quantity,
            ]);

            // if(inventory::where('product_id',$carts->product_id)->where('color_id',$carts->color_id)->where('size_id',$carts->size_id)-> decrement('quantity',$carts->quantity));

            // elseif(inventory::where('product_id',$carts->product_id)->where('size_id',$carts->size_id)-> decrement('quantity',$carts->quantity));

            // elseif(inventory::where('product_id',$carts->product_id)->where('color_id',$carts->color_id)-> decrement('quantity',$carts->quantity));
            // cart::where('customer_id',Auth::guard('customerlogin')->id())->delete();
        }
        Mail::to($request->email)->send(new invoicemail($order_id));

        // elseif()
        $order_id=substr($order_id,2);
        return redirect()->route('order.confirm',$order_id)->with('success','success');
        }
        elseif($request->payment_method==2){

        }
        else{
            $for_stripe=$request->all();
            return view('frontend.stripe',[
                'for_stripe'=>$for_stripe,
            ]);
        }



     }
     function order_confirm($order_id){
        if(session('success')){
            return view('frontend.confirm_order',[
                'order_id'=>$order_id,
            ]);
        }
        else{
            abort('404');
        }
    }
}
