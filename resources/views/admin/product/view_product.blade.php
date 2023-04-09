@extends('layouts.dashboard')


@can('view_product_list')
@section('content')
    <div class="container-floied">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <h3>View Products</h3>
                    </div>
                    <div class="card-body">
                        <table class="table table-striped">
                            <tr>
                                <th>SL</th>
                                <th>Product Name</th>
                                <th>Category</th>
                                <th>Subcategory</th>
                                <th>Price</th>
                                <th>Discount</th>
                                <th>Brand</th>
                                <th>Preview</th>
                                <th>Action</th>
                            </tr>
                            @foreach ($product as $kye=> $product )
                                <tr>
                                    <td>{{ $kye+1 }}</td>
                                    <td>{{ $product->product_name }}</td>
                                    <td>{{ $product->rel_to_cat->category_name }}</td>
                                    <td>
                                        @if (App\Models\subcategory::where('id',$product->subcategory_id)->exists())
                                        {{ $product->rel_to_subcat->subcategory_name }}
                                            @else
                                                Unknown
                                            @endif
                                    </td>
                                    <td>{{ $product->product_price }}</td>
                                    <td>{{ $product->discount }}</td>
                                    <td>{{ $product->brand }}</td>
                                    <td>
                                        <img width="100" src="{{ asset('upload/product/preview') }}/{{ $product->preview }}" alt="">
                                    </td>
                                    <td>
                                        @foreach ( App\Models\thumbnail::where('product_id',$product->id)->get() as $thumb )
                                        <img width="30" src="{{ asset('upload/product/thumbnail') }}/{{ $thumb->thumbnail }}" alt="">
                                        @endforeach
                                    </td>
                                    <td>
                                        <div class="dropdown">
                                            <button type="button" class="btn btn-success light sharp" data-toggle="dropdown">
                                                <svg width="18px" height="18px" viewBox="0 0 24 24" version="1.1"><g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"><rect x="0" y="0" width="24" height="24"></rect><circle fill="#000000" cx="5" cy="12" r="2"></circle><circle fill="#000000" cx="12" cy="12" r="2"></circle><circle fill="#000000" cx="19" cy="12" r="2"></circle></g></svg>
                                            </button>
                                            <div class="dropdown-menu dropdown-menu-right">
                                                <a class="dropdown-item" href="{{ route('delete.product',$product->id) }}">Delete</a>
                                                <a class="dropdown-item" href="{{ route('inventory',$product->id) }}">Inventory</a>
                                            </div>
                                        </div>
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
    @endcan
