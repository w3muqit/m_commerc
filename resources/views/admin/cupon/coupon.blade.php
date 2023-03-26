@extends('layouts.dashboard')

@section('content')
        <div class="row">
            <div class="col-lg-7">
                <div class="card">
                    <div class="card-header">
                        <h3>Coupon List</h3>
                    </div>
                    <div class="card-body">
                        <table class="table table-striped">
                            <tr>
                                <th>SL</th>
                                <th>Coupon Name</th>
                                <th>Discount</th>
                                <th>Expire Date</th>
                                <th>action</th>
                            </tr>
                            @foreach ($coupon as  $kye=> $coupons )
                            <tr>
                                <td>{{ $kye+1 }}</td>
                                <td>{{ $coupons->coupon_name }}</td>
                                <td>{{ $coupons->discount }} {{ ($coupons->type==1?'%':'TK') }}</td>
                                <td>{{ $coupons->expire }}</td>
                                <td>
                                    <a href="">Delete</a>
                                </td>
                            </tr>
                            @endforeach
                        </table>
                    </div>
                </div>
            </div>
            <div class="col-lg-5">
                <div class="card">
                    <div class="card-header">
                        <h3>Add Coupon</h3>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('coupon.store') }}" method="POST">
                            @csrf
                            <div class="form-group">
                                <label for="" class="form-label">Coupon Name</label>
                                <input type="text" class="form-control" name="coupon">
                            </div>
                            <div class="form-group">
                                <label for="" class="form-label">Discount</label>
                                <input type="text" class="form-control" name="discount">
                            </div>
                            <div class="form-group">
                                <select name="type" class="form-control" id="">
                                    <option value="">--Select Type--</option>
                                    <option value="1">percentage</option>
                                    <option value="2">solid discount</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="" class="form-label">Expire Date</label>
                                <input type="date" class="form-control" name="expire">
                            </div>
                            <div class="form-group">
                                <button class="btn btn-primary" type="submit">Add Coupon</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
@endsection
