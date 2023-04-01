@extends('frontend.master')

@section('content')
<section class="middle">
    <div class="container">

        <div class="row">
            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
                <div class="text-center d-block mb-5">
                    <h2>Shopping Cart</h2>
                </div>
            </div>
        </div>

        <div class="row justify-content-between">

            <div class="col-12 col-lg-7 col-md-12">
                <form action="{{ route('card.update') }}" method="POST">
                    @csrf
                <ul class="list-group list-group-sm list-group-flush-y list-group-flush-x mb-4">
                    @php
                        $subtotal=0;
                    @endphp
                    @foreach ( App\Models\cart::where('customer_id',Auth::guard('customerlogin')->id())->get()  as $cart_items )
                    <li class="list-group-item">
                        <div class="row align-items-center">
                            <div class="col-3">
                                <!-- Image -->
                                <a href="product.html"><img src="{{ asset('upload/product/preview') }}/{{ $cart_items->rel_to_pro->preview }}" alt="..." class="img-fluid"></a>
                            </div>
                            <div class="col d-flex align-items-center justify-content-between">
                                <div class="cart_single_caption pl-2">
                                    <h4 class="product_title fs-md ft-medium mb-1 lh-1">{{ $cart_items->rel_to_pro->product_name }}</h4>
                                    <p class="mb-1 lh-1"><span class="text-dark">{{ $cart_items->rel_to_size->size }}</span></p>
                                    <p class="mb-3 lh-1"><span class="text-dark"></span></p>
                                    <h4 class="fs-md ft-medium mb-3 lh-1">TK{{ $cart_items->rel_to_pro->after_discount }} X {{ $cart_items->quantity }}</h4>
                                    <div class="mb-2">
                                        <input type="number" min="1" value="{{ $cart_items->quantity }}" class="form-control" name="quantity[{{ $cart_items->id }}]">
                                    </div>
                                </div>
                                <div class="fls_last"><a href="{{ route('cart.remove',$cart_items->id) }}" class="close_slide gray"><i class="ti-close"></i></a></div>
                            </div>
                        </div>
                    </li>
                    @php
                        $subtotal+=$cart_items->rel_to_pro->after_discount*$cart_items->quantity;
                    @endphp
                    @endforeach
                </ul>

                <div class="row align-items-end justify-content-between mb-10 mb-md-0">
                    <div class="col-12 col-md-auto mfliud">
                        <button type="submit" class="btn stretched-link borders">Update Cart</button>
                    </div>
                </form>
                    <div class="col-12 col-md-7">
                        <!-- Coupon -->
                        <form class="mb-7 mb-md-0" action="" method="GET">
                            <label class="fs-sm ft-medium text-dark">Coupon code:</label>
                            <div class="row form-row">
                                <div class="col">
                                  <input class="form-control" value="{{ $coupon }}" name="coupon" type="text" placeholder="Enter coupon code*">
                                </div>
                                <div class="col-auto">
                                    <button class="btn btn-dark" type="submit">Apply</button>
                                </div>
                            </div>
                            @if ($message)
                            <div class="alert alert-warning mt-2">{{ $message }}</div>
                            @endif
                        </form>
                    </div>

                </div>

            </div>

            <div class="col-12 col-md-12 col-lg-4">
                <div class="card mb-4 gray mfliud">
                  <div class="card-body">
                    <ul class="list-group list-group-sm list-group-flush-y list-group-flush-x">
                      <li class="list-group-item d-flex text-dark fs-sm ft-regular">
                        <span>Subtotal</span> <span class="ml-auto text-dark ft-medium">{{ $subtotal }}</span>
                      </li>
                      <li class="list-group-item d-flex text-dark fs-sm ft-regular">
                        <span>Discount</span> <span class="ml-auto text-dark ft-medium">{{ ($coupon==''?'':'-') }}{{ ($type==1?$subtotal*$discount/100:$discount) }}</span>
                      </li>

                      @php
                          if($type==1){
                            $total= $subtotal -($subtotal*$discount/100);
                          }
                          else{
                            $total= $subtotal -$discount;
                          }
                      @endphp
                      <li class="list-group-item d-flex text-dark fs-sm ft-regular">
                        <span>Total</span> <span class="ml-auto text-dark ft-medium">{{ $total }}</span>
                      </li>
                      <li class="list-group-item fs-sm text-center">
                        Shipping cost calculated at Checkout *
                      </li>
                    </ul>
                  </div>
                </div>
                @php
                    session([
                        'total'=>$total,
                        'discount'=>($type==1?$subtotal*$discount/100:$discount),
                    ])
                @endphp

                <a class="btn btn-block btn-dark mb-3" href="{{ route('checkout') }}">Proceed to Checkout</a>

                <a class="btn-link text-dark ft-medium" href="shop.html">
                  <i class="ti-back-left mr-2"></i> Continue Shopping
                </a>
            </div>

        </div>

    </div>
</section>
@endsection
