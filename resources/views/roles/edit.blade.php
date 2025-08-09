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
                            <h4 class="mb-sm-0">Edit Role</h4>

                            <div class="page-title-right">
                                <ol class="breadcrumb m-0">
                                    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboards</a></li>
                                    <li class="breadcrumb-item active">Edit Role</li>
                                </ol>
                            </div>

                        </div>
                    </div>
                </div>
                <!-- end page title -->
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <form action="{{ route('role.update', $role->id) }}" method="post">
                                @csrf
                                @method('PUT')
                                <input type="hidden" name="id" value="{{ $role->id }}">
                                <div class="card-body">
                                    <h5 class="card-title">Edit Role</h5>
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
                                        <input type="text" class="form-control" id="PermissionName" name="name"
                                            value="{{ old('name', $role->name) }}">
                                    </div>
                                    <div class="mb-3">
                                        <label for="permissions" class="form-label">Permissions</label><br>
                                        @if ($permissions->isEmpty())
                                            <p>No permissions available.</p>
                                        @endif

                                        <div class="permissions-list">
                                            @foreach ($permissions as $permission)
                                                <div class="mt-3 font-weight-bold">
                                                    {{-- <input {{($rolePermissions->contains($permission->name)) ? 'checked' : ''}}type="checkbox" name="permissions[]"
                                                        value="{{ $permission->name }}"
                                                        id="permission_{{ $permission->id }}" class="mt-2 rounded">
                                                        {{ in_array($permission->id, $rolePermissions) ? 'checked' : '' }}> --}}
                                                    <input
                                                        {{ in_array($permission->name, $rolePermissions) ? 'checked' : '' }}
                                                        type="checkbox" name="permissions[]" value="{{ $permission->name }}"
                                                        id="permission_{{ $permission->id }}" class="mt-2 rounded">

                                                    <label
                                                        for="permission_{{ $permission->id }}">{{ $permission->name }}</label>
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
            flex-wrap: wrap;
            gap: 1rem;
        }
    </style>
@endsection
