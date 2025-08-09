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
                            <h4 class="mb-sm-0">Create User</h4>

                            <div class="page-title-right">
                                <ol class="breadcrumb m-0">
                                    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboards</a></li>
                                    <li class="breadcrumb-item active">Create User</li>
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
                                <form action="{{route('user.store')}}" method="POST">
                                    @csrf
                                    <div class="mb-2">
                                        <label for="user_name" class="form-label">User Name</label>
                                        <input type="text" class="form-control" id="user_name" name="name" value="{{ old('name') }}" >
                                    </div>
                                    <div class="mb-2">
                                        <label for="user_email" class="form-label">User Email</label>
                                        <input type="email" class="form-control" id="user_email" name="email" value="{{ old('email') }}" >
                                    </div>
                                    <div class="mb-2">
                                        <label for="user_password" class="form-label">Password</label>
                                        <input type="password" class="form-control" id="user_password" name="password" value="{{old('password')}}">
                                    </div>
                                    <div class="mb-2">
                                        <label for="user_password_confirmation" class="form-label">Confirm Password</label>
                                        <input type="password" class="form-control" id="user_password_confirmation" name="password_confirmation" value="{{old('password_confirmation')}}">
                                    </div>
                                    <div class="mb-2">
                                        <label for="roles" class="form-label">Assign Roles</label>
                                        <div class="Roles-list">
                                            @foreach ($roles as $role)
                                                <div class="mt-3 font-weight-bold">
                                                    <input type="checkbox" name="role[]"
                                                        value="{{ $role->name }}"
                                                        id="role_{{ $role->id }}" class="mt-2 rounded">
                                                    <label
                                                        for="role_{{ $role->id }}">{{ $role->name }}</label>
                                                    <!-- Alternatively, you can use a select box if preferred -->
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                    
                                    <button type="submit" class="btn btn-primary">Create User</button>
                                    <button type="submit" class="btn btn-secondary ms-2">
                                        <a href="{{ route('users.index') }}" class="text-white text-decoration-none">Back to User List</a>
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
            justify-content: space-evenly;
        }
    </style>
@endsection
