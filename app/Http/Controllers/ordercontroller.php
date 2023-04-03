<?php

namespace App\Http\Controllers;

use App\Models\order;
use Illuminate\Http\Request;
use PhpParser\Node\Stmt\Return_;

class ordercontroller extends Controller
{
    function view_order(){
        $order_details=order::all();
        return view('customer_order.oredr',[
            'order_details'=>$order_details,
        ]);
    }

    function order_status(Request $request){
        $order_status=$request->status;
        $after_explode=explode(',',$order_status);

        order::where('order_id',$after_explode[0])->update([
            'status'=>$after_explode[1],
        ]);
        return back();

    }

}
