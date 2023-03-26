@extends('layouts.dashboard')

@section('content')
    <div class="row">
        <div class="col-lg-4">
            <div class="card">
                <div class="card-header">
                    <h3>Edit profile</h3>
                </div>
                <div class="card-body">
                    <form action="{{ route('edit.profile') }}" method="POST">
                        @csrf
                        <div class="form-group mt-2">
                            <label for="" class="form-label">Name</label>
                            <input type="text" name="name" class=" form-control" value="{{ Auth::user()->name }}">
                        </div>
                        <div class="form-group mt-2">
                            <label for="" class="form-label">Email</label>
                            <input type="email" name="email" class=" form-control" value="{{ Auth::user()->email }}">
                        </div>
                        <div class="form-group mt-2">
                            <button class="btn btn-primary" type="submit">Update Profile</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-lg-4">
            <div class="card">
                <div class="card-header">
                    <h3>Edit Password</h3>
                </div>
                <div class="card-body">
                    <form action="{{ route('edit.password') }}" method="POST">
                        @csrf
                        <div class="form-group mt-2">
                            <label for="" class="form-label">Old Password</label>
                            <input type="password" name="old_password" class=" form-control">
                            @error('old_password')
                                <strong class="text-danger">{{ $message }}</strong>
                            @enderror
                        </div>
                        <div class="form-group mt-2">
                            <label for="" class="form-label">New Password</label>
                            <input type="password" name="password" class=" form-control">
                            @error('password')
                                <strong class="text-danger">{{ $message }}</strong>
                            @enderror
                        </div>
                        <div class="form-group mt-2">
                            <label for="" class="form-label">Confirm Password</label>
                            <input type="password" name="password_confirmation" class=" form-control">
                            @error('password_confirmation')
                                <strong class="text-danger">{{ $message }}</strong>
                            @enderror
                        </div>
                        <div class="form-group mt-2">
                            <button class="btn btn-primary" type="submit">Update Password</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-lg-4">
            <div class="card">
                <div class="card-header">
                    <h3>Edit profile Photo</h3>
                </div>
                <div class="card-body">
                    <form action="{{ route('edit.photo') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group mt-2">
                            <label for="" class="form-label">Photo</label>
                            <input type="file" name="photo" class=" form-control">
                            @error('photo')
                                <strong class="text-danger">{{ $message }}</strong>
                            @enderror
                        </div>
                        <div class="form-group mt-2">
                            <button class="btn btn-primary" type="submit">Update Profile Photo</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
