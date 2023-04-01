@extends('frontend.master')

@section('content')
<section class="middle">
    <div class="container">

        <div class="row">
            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
                <div class="text-center d-block mb-5">
                    <h2>Checkout</h2>
                </div>
            </div>
        </div>

        <div class="row justify-content-between">
            <div class="col-12 col-lg-7 col-md-12">
                <form action="{{ route('checkout.store') }}" method="POST">
                    @csrf
                    <h5 class="mb-4 ft-medium">Billing Details</h5>
                    <div class="row mb-2">
                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
                            <div class="form-group">
                                <label class="text-dark">Full Name *</label>
                                @if (Auth::guard('customerlogin')->id())
                                <input type="text" class="form-control" name="name"  value="{{ $user_info->first()->name }}" />
                                @else
                                <input type="text" class="form-control" name="name" placeholder="Name"   />
                                @endif
                            </div>
                        </div>
                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                            <div class="form-group">
                                <label class="text-dark">Email *</label>
                                @if (Auth::guard('customerlogin')->id())
                                <input type="email" name="email" class="form-control"value="{{ $user_info->first()->email }}" />
                                @else
                                <input type="text" name="email" class="form-control" placeholder="Email"   />
                                @endif
                            </div>
                        </div>

                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                            <div class="form-group">
                                <label class="text-dark">Company</label>
                                <input type="text" name="company" class="form-control" placeholder="Company Name (optional)" />
                            </div>
                        </div>
                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                            <div class="form-group">
                                <label class="text-dark">Mobile Number *</label>
                                <input type="number" name="mobile" class="form-control" placeholder="Mobile Number" />
                            </div>
                        </div>

                        <div class="col-xl-6 col-lg-12 col-md-12 col-sm-12 col-12">
                            <div class="form-group">
                                <label class="text-dark">Address *</label>
                                <input type="text" name="address" class="form-control" placeholder="Address" />
                            </div>
                        </div>
                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                            <div class="form-group">
                                <label class="text-dark">ZIP / Postcode *</label>
                                <input type="text" name="zip" class="form-control" placeholder="Zip / Postcode" />
                            </div>
                        </div>
                        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 ">
                            <div class="form-group">
                                <label class="text-dark">Country *</label>
                                <select name="country_id" class=" design custom-select js-example-basic-single " id="country">
                                    <option value="">-- Select Country --</option>
                                    @foreach ( $country as $countries )
                                    <option value="{{ $countries->id }}">{{ $countries->name }}</option>
                                  @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="col-xl-12 col-lg-6 col-md-6 col-sm-6 ">
                            <div class="form-group">
                                <select  name="city_id" id="city_id" class="form-control js-example-basic-single">
                                    <option value="">--Select City--</option>
                                </select>
                            </div>
                        </div>


                        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                            <div class="form-group">
                                <label class="text-dark">Additional Information</label>
                                <textarea name="notes" class="form-control ht-50"></textarea>
                            </div>
                        </div>

                    </div>
            </div>

            <!-- Sidebar -->
            <div class="col-12 col-lg-4 col-md-12">
                <div class="d-block mb-3">
                    <h5 class="mb-4">Order Items ({{App\Models\cart::where('customer_id',Auth::guard('customerlogin')->id())->count() }})</h5>
                    <ul class="list-group list-group-sm list-group-flush-y list-group-flush-x mb-4">
                        @foreach ( $cart_item as $cart_items )
                        <li class="list-group-item">
                            <div class="row align-items-center">
                                <div class="col-3">
                                    <!-- Image -->
                                    <a href="product.html"><img src="{{ asset('upload/product/preview') }}/{{ $cart_items->rel_to_pro->preview }}" alt="..." class="img-fluid"></a>
                                </div>
                                <div class="col d-flex align-items-center">
                                    <div class="cart_single_caption pl-2">
                                        <h4  class="product_title fs-md ft-medium mb-1 lh-1">{{ $cart_items->rel_to_pro->product_name }}</h4>
                                        <p class="mb-1 lh-1"><span class="text-dark">Size:{{ $cart_items->rel_to_size->size }}</span></p>
                                        <p class="mb-3 lh-1"><span class="text-dark">Color:{{ (App\Models\inventory::where('product_id',$cart_items->product_id)->first()->color_id=='1'?'':$cart_items->rel_to_color->color_name  )}} </span></p>
                                        <h4 class="fs-md ft-medium mb-3 lh-1">TK{{ $cart_items->rel_to_pro->after_discount }} X{{ $cart_items->quantity }}</h4>
                                    </div>
                                </div>
                            </div>
                        </li>
                        @endforeach
                    </ul>
                </div>

                <div class="mb-4">
                    <div class="form-group">
                        <h6>Delivery Location</h6>
                        <ul class="no-ul-list">
                            <li>
                                <input id="c1" class="radio-custom delivery" value="75"  name="charge" type="radio">
                                <label for="c1" class="radio-custom-label">Inside City</label>
                            </li>
                            <li>
                                <input id="c2" class="radio-custom delivery" value="150" name="charge" type="radio">
                                <label for="c2" class="radio-custom-label">Outside City</label>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="mb-4">
                    <div class="form-group">
                        <h6>Select Payment Method</h6>
                        <ul class="no-ul-list">
                            <li>
                                <input id="c3" value="1" class="radio-custom" name="payment_method" type="radio">
                                <label for="c3" class="radio-custom-label">Cash on Delivery</label>
                            </li>
                            <li>
                                <input id="c4" value="2" class="radio-custom" name="payment_method" type="radio">
                                <label for="c4" class="radio-custom-label">Pay With SSLCommerz</label>
                            </li>
                            <li>
                                <input id="c5" value="3" class="radio-custom" name="payment_method" type="radio">
                                <label for="c5" class="radio-custom-label">Pay With Stripe</label>
                            </li>
                        </ul>
                    </div>
                </div>

                <div class="card mb-4 gray">
                  <div class="card-body">
                    <ul class="list-group list-group-sm list-group-flush-y list-group-flush-x">
                      <li class="list-group-item d-flex text-dark fs-sm ft-regular">
                        <span>Subtotal</span> <span class="ml-auto text-dark ft-medium" id="sub_total" data-subtotal="{{ session('total') }}">{{ number_format(session('total')) }}</span>
                      </li>
                      <li class="list-group-item d-flex text-dark fs-sm ft-regular">
                        <span>Charge</span> <span class="ml-auto text-dark ft-medium" id="charge">TK0</span>
                      </li>
                      <li class="list-group-item d-flex text-dark fs-sm ft-regular">
                        <span>Total</span> <span class="ml-auto text-dark ft-medium" id="total" >{{ number_format(session('total')) }}</span>
                      </li>
                    </ul>
                  </div>
                </div>

                <input type="hidden" name="sub_total" value="{{ session('total') }}">
                <input type="hidden" name="discount" value="{{ session('discount') }}">
                <button type="submit" class="btn btn-block btn-dark mb-3" >Place Your Order</button>
            </form>
            </div>

        </div>

    </div>
</section>
@endsection

@section('footer_script')
    <script>
        $('.delivery').click(function(){
            var charge=$(this).val();
            var sub_total=$('#sub_total').attr('data-subtotal');
            var total = parseInt(sub_total)+parseInt(charge);
            $('#total').html(total.toLocaleString('en-US', {maximumFractionDigits:2}));
            $('#charge').html(charge);
        });

        $('#country').change(function(){
            var country_id = $(this).val();
            $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $.ajax({
            type:'POST',
            url:'/getcityid',
            data:{'city_id':country_id},
            success:function(data){
                $('#city_id').html(data);
            }
        })
        })

        $(document).ready(function() {
    $('.js-example-basic-single').select2();
});
    </script>
@endsection
