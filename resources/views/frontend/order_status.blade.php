@extends('frontend.master')

@section('content')
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="#">Home</a></li>
        <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
        <li class="breadcrumb-item active" aria-current="page">Profile Info</li>
    </ol>
    <!-- ======================= Top Breadcrubms ======================== -->

    <!-- ======================= Dashboard Detail ======================== -->
    <section class="middle">
        <div class="container">
            <div class="row align-items-start justify-content-between">

                <div class="col-12 col-md-12 col-lg-4 col-xl-4 text-center miliods">
                    <div class="d-block border rounded">
                        <div class="dashboard_author px-2 py-5">
                            <div class="dash_auth_thumb circle p-1 border d-inline-flex mx-auto mb-2">
                                <img src="assets/img/team-1.jpg" class="img-fluid circle" width="100" alt="" />
                            </div>
                            <div class="dash_caption">
                                <h4 class="fs-md ft-medium mb-0 lh-1">Adam Wishnoi</h4>
                                <span class="text-muted smalls">Australia</span>
                            </div>
                        </div>

                        <div class="dashboard_author">
                            <h4 class="px-3 py-2 mb-0 lh-2 gray fs-sm ft-medium text-muted text-uppercase text-left">
                                Dashboard Navigation</h4>
                            <ul class="dahs_navbar">
                                <li><a href="{{ route('customer.status') }}"><i class="lni lni-shopping-basket mr-2"></i>My
                                        Order</a></li>
                                <li><a href="wishlist.html"><i class="lni lni-heart mr-2"></i>Wishlist</a></li>
                                <li><a href="profile-info.html" class="active"><i class="lni lni-user mr-2"></i>Profile
                                        Info</a></li>
                                <li><a href="login.html"><i class="lni lni-power-switch mr-2"></i>Log Out</a></li>
                            </ul>
                        </div>

                    </div>
                </div>

                <div class="col-12 col-md-12 col-lg-8 col-xl-8 text-center">
                    <!-- Single Order List -->
                    @foreach (App\Models\order::where('customer_id', Auth::guard('customerlogin')->id())->get() as $status)
                        <div class="ord_list_wrap border mb-4">
                            <div class="ord_list_head gray d-flex align-items-center justify-content-between px-3 py-3">
                                <div class="olh_flex">
                                    <p class="m-0 p-0"><span class="text-muted">Order Number</span></p>
                                    <h6 class="mb-0 ft-medium">{{ $status->order_id }}</h6>
                                </div>
                                <div class="m-auto">
                                    <a class="bg-success p-2" href="{{ route('download.order',$status->id) }}">Download Invoice</a>
                                </div>
                                <div class="col-xl-2 col-lg-2 col-md-2 col-12 ml-auto">

                                    <p class="mb-1 p-0"><span class="text-muted">Status</span></p>
                                    <div class="delv_status"><span
                                            class="ft-medium small text-warning bg-light-warning rounded px-3 py-1">
                                            @php
                                                if($status->status==1){
                                                    echo 'Placed';
                                                }
                                                elseif($status->status==2){
                                                    echo 'processing';
                                                }
                                                elseif($status->status==3){
                                                    echo 'packeging';
                                                }
                                                elseif($status->status==4){
                                                    echo 'Ready to delivery';
                                                }
                                                elseif($status->status==5){
                                                    echo 'shipped';
                                                }
                                                elseif($status->status==6){
                                                    echo 'delivery';
                                                }
                                            @endphp
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <div class="ord_list_body text-left">
                                <!-- First Product -->

                                @foreach (App\Models\order_details::where('order_id', $status->order_id)->get() as $order)
                                    <div class="row align-items-center justify-content-center m-0 py-4 br-bottom">
                                        <div class="col-xl-5 col-lg-5 col-md-5 col-12">
                                            <div class="cart_single d-flex align-items-start mfliud-bot">
                                                <div class="cart_selected_single_thumb">
                                                    <a href="#"><img
                                                            src="{{ asset('upload/product/preview') }}/{{ $order->rel_to_pro->preview }}"
                                                            width="75" class="img-fluid rounded" alt=""></a>

                                                </div>
                                                <div class="cart_single_caption pl-3">
                                                    <p class="mb-0"><span class="text-muted small"></span></p>
                                                    <h4 class="product_title fs-sm ft-medium mb-1 lh-1">
                                                        {{ $order->rel_to_pro->product_name }}</h4>
                                                    <p class="mb-2"><span class="text-dark medium">Size:
                                                            {{ $order->rel_to_size->size }}</span>, <span
                                                            class="text-dark medium">Color:
                                                            {{ $order->rel_to_color->color_name }}</span></p>
                                                    <h4 class="fs-sm ft-bold mb-0 lh-1">
                                                        {{ $order->rel_to_pro->after_discount }}</h4>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                            <div class="ord_list_footer d-flex align-items-center justify-content-between br-top px-3">
                                <div
                                    class="col-xl-12 col-lg-12 col-md-12 pl-0 py-2 olf_flex d-flex align-items-center justify-content-between">
                                    <div class="olf_flex_inner">
                                        <p class="m-0 p-0"><span class="text-muted medium text-left">Order Date:
                                                10.12.2021</span></p>
                                    </div>
                                    <div class="olf_inner_right">
                                        <h5 class="mb-0 fs-sm ft-bold">Total: $4510</h5>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                    <!-- End Order List -->

                </div>

            </div>
        </div>
    </section>
@endsection
