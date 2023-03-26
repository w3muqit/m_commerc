@extends('layouts.dashboard')

@section('content')
        <div class="row">
            <div class="col-lg-8">
                <div class="card">
                    <div class="card-header">
                        <h3>Banner List</h3>
                    </div>
                    <div class="card-body">
                        <table class="table table-striped">
                            <tr>
                                <th>SL</th>
                                <th>Sub Title</th>
                                <th>Title</th>
                                <th>desp</th>
                                <th>image</th>
                                <th>Action</th>
                            </tr>
                            @foreach ( $banner as $kye=>$banners )
                              <tr>
                                 <td>{{ $kye+1 }}</td>
                                 <td>{{ $banners->sub_title }}</td>
                                 <td>{{ $banners->title }}</td>
                                 <td>{{ $banners->desp }}</td>
                                 <td>
                                    <img width="100" src="{{ asset('upload/frontend/banner') }}/{{ $banners->img }}" alt="">
                                 </td>
                                 <td>
                                    <div class="dropdown">
                                        <button type="button" class="btn btn-success light sharp" data-toggle="dropdown">
                                            <svg width="18px" height="18px" viewBox="0 0 24 24" version="1.1"><g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"><rect x="0" y="0" width="24" height="24"></rect><circle fill="#000000" cx="5" cy="12" r="2"></circle><circle fill="#000000" cx="12" cy="12" r="2"></circle><circle fill="#000000" cx="19" cy="12" r="2"></circle></g></svg>
                                        </button>
                                        <div class="dropdown-menu dropdown-menu-right">
                                            <a class="dropdown-item" href="">Active</a>
                                            <a class="dropdown-item" href="">Deactive</a>
                                            <a class="dropdown-item" href="">Delete</a>
                                        </div>
                                    </div>
                                 </td>
                              </tr>
                            @endforeach

                        </table>
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="card">
                    <div class="card-header">
                        <h3>Add Banner</h3>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('add.banner') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            {{-- sub title --}}
                            <div class="from-group">
                                <input type="text" class="form-control" name="sub_title" placeholder="Sub Title">
                                @error('sub_title')
                                    <strong class="text-danger">{{ $message }}</strong>
                                @enderror
                            </div>
                            {{-- title --}}
                            <div class="from-group mt-3">
                                <input type="text" class="form-control" name="title" placeholder="Title">
                                @error('title')
                                <strong class="text-danger">{{ $message }}</strong>
                                @enderror
                            </div>
                            {{-- desp --}}
                            <div class="from-group mt-3">
                                <input type="text" class="form-control" name="desp" placeholder="Description">
                                @error('desp')
                                <strong class="text-danger">{{ $message }}</strong>
                                @enderror
                            </div>
                            {{-- IMage --}}
                            <div class="from-group mt-3">
                                <input type="file" class="form-control" name="img">
                            </div>
                            {{-- button --}}
                            <div class="from-group mt-3">
                                <button class="btn btn-primary" type="submit">Add Banner</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
    </div>
@endsection
