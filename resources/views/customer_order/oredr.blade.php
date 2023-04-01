@extends('layouts.dashboard');

@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h2>View Order List</h2>
                </div>
                <div class="card-body">
                    <table class="table table-border">
                        <tr>
                            <th>SL</th>
                            <th>Order Id</th>
                            <th>Customer Name</th>
                            <th>Sub Total</th>
                            <th>Charge</th>
                            <th>Total</th>
                            <th>Discount</th>
                            <th>Action</th>
                        </tr>
                        @foreach ($order_details as $sl => $order_detail)
                            <tr>
                                <td>{{ $sl + 1 }}</td>
                                <td>{{ $order_detail->order_id }}</td>
                                <td>{{ $order_detail->rel_to_customer->name }}</td>
                                <td>{{ $order_detail->sub_total }}</td>
                                <td>{{ $order_detail->charge }}</td>
                                <td>{{ $order_detail->sub_total + $order_detail->charge }}</td>
                                <td>{{ $order_detail->discount }}</td>
                                <td>
                                    <div class="dropdown">
                                        <button type="button" class="btn btn-success light sharp" data-toggle="dropdown">
                                            <svg width="18px" height="18px" viewBox="0 0 24 24" version="1.1">
                                                <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                    <rect x="0" y="0" width="24" height="24">
                                                    </rect>
                                                    <circle fill="#000000" cx="5" cy="12" r="2">
                                                    </circle>
                                                    <circle fill="#000000" cx="12" cy="12" r="2">
                                                    </circle>
                                                    <circle fill="#000000" cx="19" cy="12" r="2">
                                                    </circle>
                                                </g>
                                            </svg>
                                        </button>
                                        <div class="dropdown-menu dropdown-menu-right">
                                            <form action="{{ route('order.status') }}" method="POST">
                                            @csrf
                                            <button name="status" class="dropdown-item" value="{{ $order_detail->order_id.','.'1' }}">Placed</button>
                                            <button name="status" class="dropdown-item" value="{{ $order_detail->order_id.','.'2' }}">processing</button>
                                            <button name="status" class="dropdown-item" value="{{ $order_detail->order_id.','.'3' }}">packeging</button>
                                            <button name="status" class="dropdown-item" value="{{ $order_detail->order_id.','.'4' }}">Ready to delivery</button>
                                            <button name="status" class="dropdown-item" value="{{ $order_detail->order_id.','.'5' }}">shipped</button>
                                            <button name="status" class="dropdown-item" value="{{ $order_detail->order_id.','.'6' }}">delivery</button>

                                        </div>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </form>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
