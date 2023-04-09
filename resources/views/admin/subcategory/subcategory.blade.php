@extends('layouts.dashboard')

@section('content')
@can('view_subcategory')
    <div class="container-fluied">
        <div class="row">
            <div class="col-lg-9">
                <div class="card">
                    <div class="card-header">
                        <h3>View Category</h3>
                    </div>
                    <div class="card-body">
                        <table class="table table-striped">
                            <tr>
                                <th>SL</th>
                                <th>Sub Category Name</th>
                                <th>Sub Category Image</th>
                                <th>Category Name</th>
                                <th>Created At</th>
                                <th>Action</th>
                            </tr>
                            @foreach ($subcategries as $kye=>$subcategry )

                            <tr>
                                <td>{{ $kye+1  }}</td>
                                <td>{{ $subcategry->subcategory_name  }}</td>
                                <td>
                                    <img width="50" src="{{ asset('upload/subcategory') }}/{{ $subcategry->subcategory_image }}" alt="">
                                </td>
                                <td>
                                    @if (App\Models\category::where('id',$subcategry->category_id)->exists())
                                            {{ $subcategry->rel_to_category->category_name }}
                                    @else
                                        Unknown
                                    @endif
                                </td>
                                <td>{{ $subcategry->created_at }}</td>
                                <td>
                                    @can('dit_subcategory')
                                    <a href="{{ route('edit.subcategory',$subcategry->id) }}" class="btn btn-success">Edit</a>
                                    @endcan
                                    @can('delete_subcategory')

                                    <a href="{{ route('delete.subcategory',$subcategry->id) }}" class="btn btn-danger">Delete</a>
                                    @endcan
                                </td>
                            </tr>
                            @endforeach
                        </table>
                    </div>
                </div>
            </div>
            <div class="col-lg-3">
                <div class="card">
                    <div class="card-header">
                        <h3>Add Sub Category</h3>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('add.subcategory') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="from-group mt-2">
                                <select name="category_id" id="" class="form-control">
                                    <option value="">--select Category Name--</option>
                                    @foreach ($category as $categories )

                                    <option value="{{$categories->id  }}">{{$categories->category_name  }}</option>
                                    @endforeach
                                </select>
                                @error('category_id')
                                    <strong class="text-danger">{{ $message }}</strong>
                                @enderror
                            </div>
                            <div class="from-group mt-2">
                                <label for="" class="from-label">Sub Category Name</label>
                                <input type="text" class="form-control" name="subcategory">
                                @error('subcategory')
                                    <strong class="text-danger">{{ $message }}</strong>
                                @enderror
                            </div>
                            <div class="from-group mt-2">
                                <label for="" class="from-label">Sub Category Image</label>
                                <input type="file" class="form-control" name="subcategory_img">
                                @error('subcategory_img')
                                    <strong class="text-danger">{{ $message }}</strong>
                                @enderror
                            </div>
                            <div class="from-group mt-2">
                                <button type="submit" class="btn btn-primary">Add Sub Category</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endcan
@endsection
