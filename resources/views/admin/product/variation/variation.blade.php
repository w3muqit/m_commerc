@extends('layouts.dashboard')


@section('content')

<div class="container">
    <div class="row">
        <div class="col-lg-8 ">
            <div class="card">
                <div class="card-header">
                    <h3>View Color</h3>
                </div>
                <div class="card-body">
                    <table class="table table-striped">
                        <tr>
                            <th>Sl</th>
                            <th>Color Name</th>
                            <th>Color Code</th>
                            <th>Action</th>
                        </tr>
                        @foreach ( $colors as $kye=> $color )

                        <tr>
                            <td>{{ $kye+1 }}</td>
                            <td>{{ $color->color_name }}</td>
                            <td>
                                <span class="badge badge text-success" style="background-color: #{{ $color->color_code }} "   >{{ $color->color_code }}</span>
                            </td>
                            <td>
                                <a href="{{ route('edit.color',$color->id) }}" class="btn btn-success">Edit</a>
                                <a href="{{ route('delete.color',$color->id) }}" class="btn btn-danger">Delete</a>
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
                    <h3>Add Color</h3>
                </div>
                <div class="card-body">
                    <form action="{{ route('add.variation') }}" method="POST">
                        @csrf
                        <div class="mt-3">
                            <label for="" class="form-label">Color Name</label>
                            <input type="text" class="form-control" name="color_name">
                            @error('color_name')
                                <strong class="text-danger">{{ $message }}</strong>
                            @enderror
                        </div>
                        <div class="mt-3">
                            <label for="" class="form-label">Color Code</label>
                            <input type="text" class="form-control" name="color_code">
                        </div>
                        <div class="mt-3">
                            <button class="btn btn-primary" name="btn" value="1" type="submit">Add Color</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-lg-8 ">
            <div class="card">
                <div class="card-header">
                    <h3>View Size</h3>
                </div>
                <div class="card-body">
                    <table class="table table-striped">
                        <tr>
                            <th>Sl</th>
                            <th>Size</th>
                            <th>Action</th>
                        </tr>
                        @foreach ( $sizes as $kye=> $size )

                        <tr>
                            <td>{{ $kye+1 }}</td>
                            <td>{{ $size->size }}</td>

                            <td>
                                <a href="{{ route('edit.size',$size->id) }}" class="btn btn-success">Edit</a>
                                <a href="{{ route('size.color',$size->id) }}" class="btn btn-danger">Delete</a>
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
                    <h3>Add Size</h3>
                </div>
                <div class="card-body">
                    <form action="{{ route('add.variation') }}" method="POST">
                        @csrf
                        <div class="mt-3">
                            <label for="" class="form-label">Size</label>
                            <input type="text" class="form-control" name="size">
                            @error('size')
                                <strong class="text-danger">{{ $message }}</strong>
                            @enderror
                        </div>
                        <div class="mt-3">
                            <button class="btn btn-primary" name="btn" value="2" type="submit">Add Size</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
