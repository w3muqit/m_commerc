@extends('layouts.dashboard')

@can('view_product')
@section('content')
    <div class="container">
        <div class="card">
            <div class="card-header">
                <h3>Add New Product</h3>
            </div>
            <div class="card-body">
                <form action="{{ route('add.product') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        {{-- CATEGORY --}}
                        <div class="col-lg-6">
                            <select name="category_id" id="category_id" class="form-control">
                                <option value="">--Select Category--</option>
                                @foreach ($categories as $category)
                                    <option value="{{ $category->id }}">{{ $category->category_name }}</option>
                                @endforeach
                            </select>
                        </div>

                        {{-- SUB CATEGORY --}}
                        <div class="col-lg-6">
                            <select name="subcategory_id" id="subcategory" class="form-control">
                                <option value="">--Select Sub Category--</option>
                                {{-- @foreach ($subcategories as $subcategory)
                                        <option value="{{ $subcategory->id }}">{{ $subcategory->subcategory_name }}</option>
                                    @endforeach --}}
                            </select>
                        </div>
                        {{-- PRODUCT NAME --}}
                        <div class="col-lg-4 mt-3">
                            <input type="text" name="product_name" class="form-control" placeholder="Product Name">
                        </div>
                        {{-- PRODUCT PRICE --}}
                        <div class="col-lg-4 mt-3">
                            <input type="number" name="product_price" class="form-control" placeholder="Product Price">
                        </div>
                        {{-- DISCOUNT --}}
                        <div class="col-lg-4 mt-3">
                            <input type="number" name="discount" class="form-control" placeholder="Discount %">
                        </div>

                        {{-- PRODUCT BRAND --}}
                        <div class="col-lg-3 mt-3">
                            <input type="text" name="brand" class="form-control" placeholder="Product Brand">
                        </div>
                        {{-- PRODUCT BRAND Image --}}
                        <div class="col-lg-3 mt-3">
                            <input type="file" name="brand_img" class="form-control">
                        </div>

                        {{-- SHORT DISCRIPTION --}}
                        <div class="col-lg-6 mt-3">
                            <input type="text" name="short_desp" class="form-control" placeholder="Short Description">
                        </div>
                        {{-- LONG DISCRIPTION --}}
                        <div class="col-lg-12 mt-3">
                            <textarea name="long_desp" id="summernote"></textarea>
                        </div>
                        {{-- PRODT  PREVIEW --}}
                        <div class="col-lg-6 mt-3">
                            <input type="file" name="preview" class="form-control">
                        </div>
                        {{-- PRODT  THUMBNAILS --}}
                        <div class="col-lg-6 mt-3">
                            <input type="file" name="thumbnails[]" multiple class="form-control">
                        </div>
                        {{-- BUTTON --}}
                        <div class="col-lg-12 text-center mt-3">
                            <button class="btn btn-primary">Add Product</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    @endsection
    @endcan

@section('footer_script')
    <script>
        $('#category_id').change(function() {
            var category_id = $(this).val();

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $.ajax({
                url: '/getsubcategory',
                type: 'POST',
                data: {
                    'category_id': category_id
                },
                success: function(data) {
                    $('#subcategory').html(data);
                }

            })

        });
    </script>


    <script>
        $(document).ready(function() {
            $('#summernote').summernote();
        });
    </script>
@endsection
