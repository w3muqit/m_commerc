<?php

namespace App\Http\Controllers;

use App\Models\customerlogin;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;

class CustomerREgcontroller extends Controller
{
    function customer_log_reg(Request $request){
        customerlogin::insert([
            'name'=>$request->name,
            'email'=>$request->email,
            'password'=>bcrypt($request->password),
            'created_at'=>Carbon::Now(),
        ]);
        if(Auth::guard('customerlogin')->attempt(['email' => $request->email, 'password' => $request->password])){
            return redirect('/');
        }
    }
}
