@extends('layouts.dashboard')


@section('content')
    <div class="container">
        <div class="row">
            <div class="col-lg-5 m-auto">
                <div class="card">
                    <div class="card-header">
                        <h3>Edit Sub Category</h3>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('update.subcategory') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="subcategory_id" value="{{ $subcategories->id }}">
                        {{-- category aria --}}
                        <div class="form-group mt-3">
                            <select name="category_id" id="" class="form-control">
                                <option value="">--Select Sub Category--</option>
                                 @foreach ($categories as $category )
                                 <option value="{{$category->id}}" {{($category->id==$subcategories->category_id?'selected':'')}}>{{$category->category_name}}</option>
                                 @endforeach
                            </select>
                        </div>
                        {{-- Sub Category --}}
                        <div class="form-group mt-3">
                            <label for="" class="form-label">Sub Category Name</label>
                            <input type="text" class="form-control" name="subcategory_name" value="{{ $subcategories->subcategory_name }}">
                        </div>
                        {{-- Sub Category Image --}}
                        <div class="form-group mt-3">
                            <label for="" class="form-label">Sub Category Image</label>
                            <input type="file" class="form-control" name="subcategory_img"  onchange="document.getElementById('blah').src = window.URL.createObjectURL(this.files[0])">
                            <div class="mt-3">
                                <img width="100" id="blah" src="{{ asset('upload/subcategory') }}/{{ $subcategories->subcategory_image }}" alt="">
                            </div>
                        </div>
                        {{-- Button Aria --}}
                        <div class="form-group mt-3">
                            <button class="btn btn-primary" type="submit">Update Sub Category</button>
                        </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
