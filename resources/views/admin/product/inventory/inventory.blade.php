@extends('layouts.dashboard')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-lg-8">
                <div class="card">
                    <div class="card-header">
                        <h3>Inventory List</h3>
                    </div>
                    <div class="card-body">
                        <table class="table table-striped">
                            <tr>
                                <th>SL</th>
                                <th>Product Name</th>
                                <th>Color</th>
                                <th>Size</th>
                                <th>Quantity</th>
                                <th>action</th>
                            </tr>
                            @foreach ($inventory as $kye=> $inventorys )
                             <tr>
                                <td>{{ $kye }}</td>
                                <td>{{ $inventorys->rel_to_pro->product_name }}</td>

                                <td>
                                    @if (App\Models\color::where('id',$inventorys->color_id)->exists())
                                    {{ $inventorys->rel_to_color->color_name }}
                                    @else
                                        Unknown
                                    @endif
                                </td>
                                <td>
                                    @if (App\Models\size::where('id',$inventorys->size_id)->exists())
                                    {{ $inventorys->rel_to_size->size }}
                                    @else
                                        Unknown
                                    @endif
                                </td>
                                <td>{{ $inventorys->quantity }}</td>
                                <td>
                                    <a href="{{ route('delete.inventory',$inventorys->id) }}" class="btn btn-danger">Delete</a>
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
                        <h3>Add Inventory</h3>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('add.inventory') }}" method="POST">
                            @csrf
                            <input type="hidden" name="product_id" value="{{ $product_info->id }}">
                            {{-- name --}}
                            <div >
                                <label for="" class="form-label">Product Name</label>
                                <input type="text" class="form-control" name="product" readonly value="{{ $product_info->product_name }}">
                            </div>
                            {{-- quantity --}}
                            <div class="mt-2">
                                <label for="" class="form-label">Quantity</label>
                                <input type="text" class="form-control" name="quantity" >
                            </div>
                            {{-- color --}}
                            <div class="mt-2">
                                <select name="color_id" id="" class="form-control">
                                    <option value="">--Select Color--</option>
                                    @foreach ( $colors as $color )
                                        <option value="{{ $color->id }}">{{ $color->color_name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            {{-- size --}}
                            <div class="mt-2">
                                <select name="size_id" id="" class="form-control">
                                    <option value="">--Select Size--</option>
                                    @foreach ( $sizes as $size )
                                        <option value="{{ $size->id }}">{{ $size->size }}</option>
                                    @endforeach
                                </select>
                            </div>
                            {{-- button --}}
                            <div class="mt-3">
                               <button class="btn btn-primary" type="submit">Add Inventory</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
