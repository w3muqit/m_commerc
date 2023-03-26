@extends('frontend.master')
@section('content')
<section class="middle">
    <div class="container">
        <div class="row align-items-start justify-content-between">

            <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12">
                <div class="mb-3">
                    <h3>Login</h3>
                </div>
                @if (session('login'))
                    <div class="alert">{{session('login')}}</div>
                @endif
                <form class="border p-3 rounded" action="{{ route('customer.login') }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label>Email *</label>
                        <input type="email" name="email" class="form-control" placeholder="Email*">
                    </div>

                    <div class="form-group">
                        <label>Password *</label>
                        <input type="password" name="password" class="form-control" placeholder="Password*">
                    </div>

                    <div class="form-group">
                        <div class="d-flex align-items-center justify-content-between">
                            <div class="eltio_k2">
                                <a href="#">Lost Your Password?</a>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <button type="submit" class="btn btn-md full-width bg-dark text-light fs-md ft-medium">Login</button>
                    </div>
                </form>
            </div>

            <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 mfliud">
                <div class="mb-3">
                    <h3>Register</h3>
                </div>
                <form class="border p-3 rounded " action="{{ route('customer.log.reg') }}" method="POST">
                    @csrf
                    <div class="row">
                        <div class="form-group col-md-12">
                            <label>Full Name *</label>
                            <input type="text" name="name" class="form-control" placeholder="Full Name">
                        </div>
                    </div>

                    <div class="form-group">
                        <label>Email *</label>
                        <input type="email"  name="email" class="form-control" placeholder="Email*">
                    </div>

                    <div class="row">
                        <div class="form-group col-md-12">
                            <label>Password *</label>
                            <input type="password" name="password" class="form-control" placeholder="Password*">
                        </div>

                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-md full-width bg-dark text-light fs-md ft-medium">Create An Account</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>
@endsection
