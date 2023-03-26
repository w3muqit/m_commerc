@extends('layouts.dashboard')

@section('content')
        <div class="container-floied">
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
                                    <th>Category Name</th>
                                    <th>Icon</th>
                                    <th>Category Image</th>
                                    <th>Added By</th>
                                    <th>Created At</th>
                                    <th>Action</th>
                                </tr>
                                @foreach ($category as $kye=>$category )

                                <tr>
                                    <td>{{ $kye+1  }}</td>
                                    <td>{{ $category->category_name  }}</td>
                                    <td>
                                        <i class="fa {{ $category->icon }}"></i>
                                    </td>
                                    <td>
                                        <img width="50" src="{{ asset('upload/category') }}/{{ $category->category_image }}" alt="">
                                    </td>
                                    <td>
                                        @if (App\Models\user::where('id',$category->added_by)->exists())
                                                {{ $category->rel_to_user->name }}
                                        @else
                                            Unknown
                                        @endif
                                    </td>
                                    <td>{{ $category->created_at->diffForHumans()  }}</td>
                                    <td>
                                        <a href="{{ route('edit.category',$category->id) }}" class="btn btn-success">Edit</a>
                                        <a href="{{ route('delete.category',$category->id) }}" class="btn btn-danger">Delete</a>
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
                            <h3>Add Category</h3>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('add.category') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <?php /**
                                     * Font Awesome 4.7.0 All Icons In One Array php
                                     * http://fontawesome.io/cheatsheet/
                                     */

                                    $fonts = array (
                                        'fab fa-android',
                                        'fab fa-apple' ,
                                        'fas fa-bath',
                                        'fas fa-bed',
                                        'fas fa-bicycle',
                                        'fas fa-bus',
                                        'fas fa-camera',
                                        'fas fa-car',
                                        'fas fa-clock',
                                        'fas fa-desktop',
                                        'fas fa-female',
                                        'fas fa-futbol',
                                        'fas fa-home' ,
                                        'fas fa-laptop',
                                        'fas fa-microphone',
                                        'fas fa-mobile',
                                        'fas fa-phone' ,
                                        'fas fa-shopping-bag',
                                        'fas fa-shopping-basket',
                                        'fas fa-shower',
                                        'fas fa-table',
                                        'fas fa-tablet' ,
                                        'fas fa-truck',
                                        'fas fa-user' ,
                                        'far fa-user' ,
                                    );

                                    ?>
                                <div class="form-group">
                                    <div class="mb-2">
                                        @foreach ( $fonts as $font )
                                        <i  style="font-size:25px;margin-right:5px" data-icon="{{ $font }}" class="fa {{ $font }} "></i>
                                        @endforeach
                                    </div>
                                    <label for="" class="form-label">Icon</label>
                                    <input type="text" id="icon" name="icon" class="form-control" name="category_name">
                                </div>
                                <div class="form-group mt-3">
                                    <label for="" class="form-label">Category Name</label>
                                    <input type="text" class="form-control" name="category_name">

                                    @error('category_name')
                                        <strong class="text-danger">{{ $message }}</strong>
                                    @enderror
                                </div>
                                <div class="form-group mt-3">
                                    <label for="" class="form-label">Category Image</label>
                                    <input type="file" class="form-control" name="category_img">
                                    {{-- @error('category_img')
                                        <strong class="text-danger">{{ $message }}</strong>
                                    @enderror --}}
                                </div>
                                <div class="form-group mt-3">
                                    <button class="btn btn-primary" type="submit">Add Category</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-8">
                    <div class="card">
                        <div class="card-header">
                            <h3>View Category</h3>
                        </div>
                        <div class="card-body">
                            <table class="table table-striped">
                                <tr>
                                    <th>SL</th>
                                    <th>Category Name</th>
                                    <th>Category Image</th>
                                    <th>Added By</th>
                                    <th>Created At</th>
                                    <th>Action</th>
                                </tr>
                                @foreach ($trashed as $kye=>$category )

                                <tr>
                                    <td>{{ $kye+1  }}</td>
                                    <td>{{ $category->category_name  }}</td>
                                    <td>
                                        <img width="50" src="{{ asset('upload/category') }}/{{ $category->category_image }}" alt="">
                                    </td>
                                    <td>
                                        @if (App\Models\user::where('id','added_by')->exists())
                                                {{ $category->rel_to_user->name }}
                                        @else
                                            Unknown
                                        @endif
                                    </td>
                                    <td>{{ $category->created_at->diffForHumans()  }}</td>
                                    <td>
                                        <a href="{{ route('restopre.category',$category->id) }}" class="btn btn-success">Restore</a>
                                        <a href="{{ route('hard.delete.category',$category->id) }}" class="btn btn-danger">Delete</a>
                                    </td>
                                </tr>
                                @endforeach
                            </table>
                        </div>
                    </div>
                </div>

            </div>
        </div>
@endsection
@section('footer_script')

    <script>
        $('.fa').click(function(){
            var icon = $(this).attr('data-icon');
            $('#icon').attr('value',icon);
        })
    </script>

@endsection
