@extends('layouts.dashboard')

@section('content')
        <div class="container">
            <div class="row">
                <div class="col-lg-4 m-auto">
                    <div class="card">
                        <div class="card-header">
                            <h3>Edit Size</h3>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('update.size') }}" method="POST">
                                @csrf
                                <input type="hidden" name="size_id" value="{{ $size->id }}">
                                <div class="mt-3">
                                    <label for="" class="form-label">Size</label>
                                    <input type="text" name="size" class="form-control" value="{{ $size->size }}">
                                </div>
                                <div class="mt-3">
                                    <button class="btn btn-primary" type="submit">Update Size</button>
                                </div>

                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
@endsection

