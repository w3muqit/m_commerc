@extends('layouts.dashboard')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-lg-5 m-auto">
                <div class="card">
                    <div class="card-header">
                        <h3>Edit Category</h3>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('update.category') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" name="category_id" value="{{ $categories->id }}">
                        <div class="form-group mt-3">
                            <label for="" class="form-label">Category Name</label>
                            <input type="text" class="form-control" name="cateory_name" value="{{ $categories->category_name }}">
                            </div>
                        <div class="form-group mt-3">
                            <label for="" class="form-label">Category Image</label>
                            <input type="file" class="form-control" name="cateory_image" onchange="document.getElementById('blah').src = window.URL.createObjectURL(this.files[0])">
                            <div class="mt-2">
                                <img id="blah" width="100" src="{{ asset('upload/category') }}/{{ $categories->category_image }}" alt="">
                            </div>
                            </div>
                        <div class="form-group mt-3">
                            <button class="btn btn-primary" type="submit">Update Category</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
