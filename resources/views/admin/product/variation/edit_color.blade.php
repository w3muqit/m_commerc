@extends('layouts.dashboard')

@section('content')
        <div class="container">
            <div class="row">
                <div class="col-lg-4 m-auto">
                    <div class="card">
                        <div class="card-header">
                            <h3>Edit Color</h3>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('update.color') }}" method="POST">
                                @csrf
                                <input type="hidden" name="color_id" value="{{ $color->id }}">
                                <div class="mt-3">
                                    <label for="" class="form-label">Color Name</label>
                                    <input type="text" name="color_name" class="form-control" value="{{ $color->color_name }}">
                                </div>
                                <div class="mt-3">
                                    <label for="" class="form-label">Color Code</label>
                                    <input type="text" name="color_code" class="form-control" value="{{ $color->color_code }}" >
                                </div>
                                <div class="mt-3">
                                    <button class="btn btn-primary"  type="submit">Update Color</button>
                                </div>

                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
@endsection

