<?php

namespace App\Http\Controllers;

use App\Models\cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class checkoutcontroller extends Controller
{
    function checkout(){
        $cart_item=cart::where('customer_id',Auth::guard('customerlogin')->id())->get();
        return view('frontend.checkout',[
            'cart_item'=>$cart_item,
        ]);
    }
}
