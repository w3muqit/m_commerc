<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;
use Stripe;
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
use Illuminate\Support\Facades\Auth;
use Str;
use Illuminate\Support\Facades\Mail;

class StripePaymentController extends Controller
{
    /**
     * success response method.
     *
     * @return \Illuminate\Http\Response
     */
    public function stripe()
    {
        return view('stripe');
    }

    /**
     * success response method.
     *
     * @return \Illuminate\Http\Response
     */
    public function stripePost(Request $request)
    {
        $data=session('for_stripe');

        Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));

        Stripe\Charge::create ([
                "amount" => 100 * $data['sub_total'] + $data['charge'],
                "currency" => "bdt",
                "source" => $request->stripeToken,
                "description" => "Test payment from itsolutionstuff.com."
        ]);

        $order_id='#'.'-'.Str::random(3).rand(555555555,6666666);
                       // order store//
                       order::insert([
                        'order_id'=>$order_id,
                        'customer_id'=>Auth::guard('customerlogin')->id(),
                        'sub_total'=>$data['sub_total'],
                        'total'=>$data['sub_total'] + $data['charge'],
                        'discount'=>$data['discount'],
                        'charge'=>$data['charge'],
                        'payment_method'=> $data['payment_method'],
                        'created_at'=>Carbon::Now(),
                    ]);

                    // billing //
                    billingdetails::insert([
                        'order_id'=>$order_id,
                        'customer_id'=>Auth::guard('customerlogin')->id(),
                        'name'=>$data['name'],
                        'email'=>$data['email'],
                        'company'=>$data['company'],
                        'mobile'=>$data['mobile'],
                        'address'=>$data['address'],
                        'country_id'=>$data['country_id'],
                        'city_id'=>$data['city_id'],
                        'zip'=>$data['zip'],
                        'nots'=>$data['notes'],
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
                    Mail::to($data['email'])->send(new invoicemail($order_id));

                    // elseif()
                    $order_id=substr($order_id,2);
                    return redirect()->route('order.confirm',$order_id)->with('success','success');
    }
}
