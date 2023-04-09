@extends('layouts.dashboard')

@section('content')
@can('view_user')


    <div class="row">
        <div class="col-lg-8 m-auto">
            <div class="card">
                <div class="card-header">
                    <h3>Users List</h3>
                </div>
                <div class="card-body">
                    <table class="table table-striped">
                        <tr>
                            <th>Sl</th>
                            <th>NAME</th>
                            <th>EMAIL</th>
                            <th>PHOTO</th>
                            <th>CREATED AT</th>
                            <th>ACTION</th>
                        </tr>
                        @foreach ($user as $kye=>$users )

                        <tr>
                            <td>{{ $kye+1 }}</td>
                            <td>{{$users->name }}</td>
                            <td>{{$users->email }}</td>
                            <td>
                                {{-- @if ($users->photo==null)
                                <img width="50" src="{{ Avatar::create($users->name)->toBase64() }}" />
                                @else
                                    <img width="50" src="{{ asset('upload/user') }}/{{ $users->photo }}" alt="">
                                @endif --}}
                            </td>
                            <td>{{ $users->created_at->diffForHumans() }}</td>
                            <td>
                                <a href="{{ route('user.delete',$users->id) }}" class="btn btn-danger">Delete</a>
                            </td>
                        </tr>
                        @endforeach
                    </table>
                </div>
            </div>
        </div>
    </div>
    @endcan
@endsection
