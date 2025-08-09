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
                            <h4 class="mb-sm-0">Create Role</h4>

                            <div class="page-title-right">
                                <ol class="breadcrumb m-0">
                                    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard')}}">Dashboards</a></li>
                                    <li class="breadcrumb-item active">Create Role</li>
                                </ol>
                            </div>

                        </div>
                    </div>
                </div>
                <!-- end page title -->
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                @if ($errors->any())
                                    <div class="alert alert-danger">
                                        <ul>
                                            @foreach ($errors->all() as $error)
                                                <li>{{ $error }}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                @endif
                                <form action="{{ route('role.store') }}" method="POST">
                                    @csrf
                                    <div class="mb-2">
                                        <label for="role_name" class="form-label">Role Name</label>
                                        <input type="text" class="form-control" id="role_name" name="name"
                                            value="{{ old('name') }}">
                                    </div>
                                    <div class="mb-3">
                                        <label for="permissions" class="form-label">Permissions</label><br>
                                        @if ($permissions->isEmpty())
                                            <p>No permissions available.</p>
                                        @endif

                                        <div class="permissions-list">
                                            @foreach ($permissions as $permission)
                                                <div class="mt-3 font-weight-bold">
                                                    <input type="checkbox" name="permissions[]"
                                                        value="{{ $permission->name }}"
                                                        id="permission_{{ $permission->id }}" class="mt-2 rounded">
                                                    <label
                                                        for="permission_{{ $permission->id }}">{{ $permission->name }}</label>
                                                    <!-- Alternatively, you can use a select box if preferred -->
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                    <button type="submit" class="btn btn-primary">Create Role</button>
                                    <button type="submit" class="btn btn-secondary ms-2">
                                        <a href="{{ route('roles.index') }}" class="text-white text-decoration-none">Back to
                                            Roles List</a>
                                    </button>
                                </form>
                            </div>
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
            /* optional spacing between items */
        }

        .permissions-list>* {
            flex: 1 1 calc(25% - 1rem);
            /* 4 items per row */
            box-sizing: border-box;
        }
    </style>
@endsection
