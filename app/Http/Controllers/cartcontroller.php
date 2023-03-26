<?php

namespace App\Http\Controllers;

use App\Models\cart;
use App\Models\color;
use App\Models\inventory;
use App\Models\wishlist;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Carbon;

class cartcontroller extends Controller
{
    function cart_store(Request $request){
        if($request->btn==1){
            if(inventory::where('product_id',$request->product_id)->first()->color_id== 1){
                $available_product=inventory::where('product_id',$request->product_id)->where('size_id',$request->size_id)->first()->quantity;
            }
            else{
                $available_product=inventory::where('product_id',$request->product_id)->where('color_id',$request->color_id)->where('size_id',$request->size_id)->first()->quantity;
            }

            if($available_product >= $request->quantity){

                if(cart::where('customer_id',Auth::guard('customerlogin')->id())->where('product_id',$request->product_id)->where('color_id',$request->color_id)->where('size_id',$request->size_id)->exists()){
                    cart::where('customer_id',Auth::guard('customerlogin')->id())->where('product_id',$request->product_id)->where('color_id',$request->color_id)->where('size_id',$request->size_id)->increment('quantity',$request->quantity);
                    return back();
                }
                else{
                    if(Auth::guard('customerlogin')->check()){
                        cart::insert([
                            'customer_id'=>Auth::guard('customerlogin')->id(),
                            'product_id'=>$request->product_id,
                            'color_id'=>$request->color_id,
                            'size_id'=>$request->size_id,
                            'quantity'=>$request->quantity,
                            'created_at'=>Carbon::Now(),
                        ]);
                        return back();
                        }
                               else{
                                return view('frontend.customer_register')->with('login','please Login to add cart');
                               }
                        }
                }
            else{
                return back()->with('stock','Out of stock, total stock:'.$available_product);
            }
        }
        else{

            if(Auth::guard('customerlogin')->check()){
                wishlist::insert([
                    'customer_id'=>Auth::guard('customerlogin')->id(),
                    'product_id'=>$request->product_id,
                    'created_at'=>Carbon::Now(),
                ]);
                return back();
                }
                       else{
                        return view('frontend.customer_register')->with('login','please Login to Wishlist');
                        // return redirect()->route('customer.login');
                       }
        }


    }

    function cart_remove($cart_id){
        cart::find($cart_id)->delete();
        return back();
    }

    function wishlist_remove($wish_id){
        wishlist::find($wish_id)->delete();
        return back();
    }

    
}

