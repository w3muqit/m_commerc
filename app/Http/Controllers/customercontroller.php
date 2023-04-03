<?php

namespace App\Http\Controllers;

use App\Models\billingdetails;
use App\Models\order;
use App\Models\order_details;
use Illuminate\Http\Request;
use PDF;

class customercontroller extends Controller
{
    // my order details //




    // my order details //


    function invoice($order_id){
        $data= order::find($order_id);
        $customer_info=billingdetails::where('order_id',$data->order_id)->get();
        $order_info=order_details::where('order_id',$data->order_id)->get();
        $invoice_info = PDF::loadView('invoice.download_invoice', [
            'data'=>$data,
            'customer_info'=>$customer_info,
            'order_info'=>$order_info,
        ]);

        return $invoice_info->download('invoice.pdf');
    }

    // function test_invoice($order_id){

    //     return view('invoice.download_invoice');
    // }
}
