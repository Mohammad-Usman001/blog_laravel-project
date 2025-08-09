@extends('admin.layout.master')
@section('content')
    <!-- start page title -->
    <div class="main-content">

        <div class="page-content">
            <div class="container-fluid">
                <!-- start page title -->
                <div class="row">
                    <div class="col-12">
                        <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                            <h4 class="mb-sm-0">Edit User</h4>

                            <div class="page-title-right">
                                <ol class="breadcrumb m-0">
                                    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboards</a></li>
                                    <li class="breadcrumb-item active">Edit User</li>
                                </ol>
                            </div>

                        </div>
                    </div>
                </div>
                <!-- end page title -->
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <form action="{{route('user.update', $users->id)}}" method="post">
                                @csrf
                                @method('PUT')
                                <input type="hidden" name="id" value="{{ $users->id }}">
                                <div class="card-body">
                                    <h5 class="card-title">Edit User</h5>
                                    @if ($errors->any())
                                        <div class="alert alert-danger">
                                            <ul>
                                                @foreach ($errors->all() as $error)
                                                    <li>{{ $error }}</li>
                                                @endforeach
                                            </ul>
                                        </div>
                                    @endif
                                    <div class="mb-3">
                                        <input type="text" class="form-control" name="name"
                                            value="{{ old('name', $users->name) }}">
                                    </div>
                                    <div class="mb-3">
                                        <input type="text" class="form-control" name="email"
                                            value="{{ old('email', $users->email) }}">
                                    </div>
                                    <div class="mb-3">
                                        <label for="Roles" class="form-label">Roles</label><br>
                                       

                                        <div class="roles-list">
                                            @foreach ($roles as $role)
                                                <div class="mt-3 font-weight-bold">
                                                    {{-- <input {{($rolePermissions->contains($permission->name)) ? 'checked' : ''}}type="checkbox" name="permissions[]"
                                                        value="{{ $permission->name }}"
                                                        id="permission_{{ $permission->id }}" class="mt-2 rounded">
                                                        {{ in_array($permission->id, $rolePermissions) ? 'checked' : '' }}> --}}
                                                         
                                                    <input
                                                        {{ ($hasRoles->contains($role->id))? 'checked' : '' }}
                                                        type="checkbox" name="role[]" value="{{ $role->name }}"
                                                        id="role_{{ $role->id }}" class="mt-2 rounded">

                                                    <label
                                                        for="role_{{ $role->id }}">{{ $role->name }}</label>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                    <button type="submit" class="btn btn-primary">Update Role</button>
                                    <button type="submit" class="btn btn-secondary ms-2">
                                        <a href="{{ route('roles.index') }}" class="text-white">
                                            Back</a></button>
                                </div>

                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
      <style>
        .permissions-list {
            display: flex;
            justify-content: space-evenly;
        }
    </style>
@endsection
