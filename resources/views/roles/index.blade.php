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
                            <h4 class="mb-sm-0">Roles List</h4>

                            <div class="page-title-right">
                                <ol class="breadcrumb m-0">
                                    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboards</a></li>
                                    <li class="breadcrumb-item active">Roles List</li>
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
                                @if (Session::has('success'))
                                    <div class="alert alert-success">
                                        {{ Session::get('success') }}
                                    </div>
                                @endif
                                @if ($errors->any())
                                    <div class="alert alert-danger">
                                        <ul>
                                            @foreach ($errors->all() as $error)
                                                <li>{{ $error }}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                @endif
                                @can('create roles')
                                <a href="{{ route('role.create') }}" class="btn btn-primary mb-3 ms-auto">Create Role</a>
                                @endcan
                                <table class="table table-bordered">
                                    <tr>
                                        <th>Role Name</th>
                                        <th>Permissions</th>
                                        <th>Created At</th>
                                        <th>Action</th>
                                    </tr>
                                    @if($roles->isEmpty())
                                    <tr>
                                        <td colspan="4" class="text-center">No roles found</td>
                                    </tr>
                                    @endif
                                    @foreach($roles as $role)
                                    <tr>
                                        <td>{{ $role->name }}</td>
                                        <td>
                                            @foreach($role->permissions as $permission)
                                                {{ $permission->name }}@if(!$loop->last), @endif
                                            @endforeach
                                        </td>
                                        <td>{{\carbon\carbon::parse($role->created_at)->format('d M, Y')  }}</td>
                                        <td>
                                            @can('edit roles')
                                            <a href="{{route('role.edit', $role->id)}}" class="btn btn-warning " style="display:inline-block ">Edit</a>
                                            @endcan
                                            @can('delete roles')
                                            <form action="{{route('role.destroy', $role->id)}}" method="POST" style="display:inline-block; margin-right: 5px;" class="delete-role-form">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger">Delete</button>
                                            </form>
                                            @endcan
                                        </td>
                                    </tr>
                                    @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const deleteForms = document.querySelectorAll('.delete-role-form');
            deleteForms.forEach(form => {
                form.addEventListener('submit', function (event) {
                   if (!confirm('Are you sure you want to delete this Role?')) {
                            event.preventDefault();
                        }
                });
            });
        });
    </script>
@endsection
