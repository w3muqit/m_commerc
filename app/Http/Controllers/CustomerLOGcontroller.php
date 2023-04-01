<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CustomerLOGcontroller extends Controller
{
    function customer_login(Request $request){
        if(Auth::guard('customerlogin')->attempt(['email' => $request->email, 'password' => $request->password])){
            return redirect('/');
        }
        else{
            return view('frontend.customer_register');
        }
    }

    function customer_logout(){
        Auth::guard('customerlogin')->logout();
        return redirect('/');
    }
    function customer_profile(){
        return view('frontend.customer_profile');
    }
    function customer_status(){
        return view('frontend.order_status');
        }
}
