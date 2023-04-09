@extends('layouts.dashboard')

@section('content')
    @can('view_permission')


    <div class="row">
        <div class="col-lg-8">
            <div class="card">
                <div class="card-header">
                    <h3>Role Info</h3>
                </div>
                <div class="card-body">
                    <table class="table table-striped">
                        <tr>
                            <th>SL</th>
                            <th>Role Name</th>
                            <th>Permissions</th>
                            {{-- <th>Action</th> --}}
                        </tr>
                        @foreach ($roles as $sl=>$role )
                            <tr>
                                <td>{{ $sl+1 }}</td>
                                <td>{{ $role->name }}</td>
                                <td>@foreach ($role->getPermissionNames() as $permis )
                                    <span class="badge badge-primary m-1">{{ $permis }}</span>
                                @endforeach</td>
                                {{-- <td><a href="{{ route('permission.remove',$role->id) }}" class="btn btn-danger">remove_per</a></td> --}}
                            </tr>
                        @endforeach
                    </table>
                </div>
            </div>
        </div>
        {{-- <div class="col-lg-4">
            <div class="card">
                <div class="card-header">
                    <h3>Add permission</h3>
                </div>
                <div class="card-body">
                    <form action="{{ route('permission.store') }}" method="POST">
                        @csrf
                        <div class="">
                            <label for="" class="form-label">permission</label>
                            <input type="text" class="form-control" name="permission">
                        </div>
                        <div class="mt-3">
                           <button class="btn btn-primary" type="submit">Add permission</button>
                        </div>
                    </form>
                </div>
            </div>
        </div> --}}
        <div class="col-lg-4">
            <div class="card">
                <div class="card-header">
                    <h3>Add Role</h3>
                </div>
                <div class="card-body">
                    <form action="{{ route('role.store') }}" method="POST">
                        @csrf
                        <div class="">
                            <label for="" class="form-label">Role</label>
                            <input type="text" class="form-control" name="role">
                        </div>
                        <div class="">
                            @foreach ($permissions as $permission )
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" name="permission[]" type="checkbox"  value="{{ $permission->id }}">
                                <label class="form-check-label"  >{{ $permission->name }}</label>
                              </div>
                            @endforeach
                        </div>
                        <div class="mt-3">
                           <button class="btn btn-primary" type="submit">Add Role</button>
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
                    <h3>Role Info</h3>
                </div>
                <div class="card-body">
                    <table class="table table-striped">
                        <tr>
                            <th>SL</th>
                            <th>Role Name</th>
                            <th>Permissions</th>
                            <th>Action</th>
                        </tr>
                        @foreach ($users as $sl=>$user )
                            <tr>
                                <td>{{ $sl+1 }}</td>
                                <td>{{ $user->name }}</td>
                                <td>@forelse ($user->getRoleNames() as $role )
                                    <span class="badge badge-primary m-1">{{ $role }}</span>
                                    @empty
                                        <span class="badge badge-light m-1">Not Assign</span>
                                @endforelse</td>
                                <td><a href="{{ route('remove.role',$user->id) }}">Remove Role</a></td>
                            </tr>
                        @endforeach
                    </table>
                </div>
            </div>
        </div>

        <div class="col-lg-4">
            <div class="card">
                <div class="card-header">
                    <h3>Asign Role</h3>
                </div>
                <div class="card-body">
                    <form action="{{ route('asign.store') }}" method="POST">
                        @csrf
                        <div class="">
                           <select name="user_id" id="" class="form-control">
                            <option value="">--Select Users--</option>
                            @foreach ($users as $user )
                            <option value="{{ $user->id }}">{{ $user->name }}</option>
                            @endforeach

                           </select>
                        </div>
                        <div class="mt-2">
                           <select name="role_id" id="" class="form-control">
                            <option value="">--Select Role--</option>
                            @foreach ($roles as $roles )
                            <option value="{{ $roles->id }}">{{ $roles->name }}</option>
                            @endforeach

                           </select>
                        </div>
                        <div class="mt-3">
                           <button class="btn btn-primary" type="submit">Asign Role</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    @endcan
@endsection
