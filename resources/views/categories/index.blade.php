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
                            <h4 class="mb-sm-0">Category List</h4>

                            <div class="page-title-right">
                                <ol class="breadcrumb m-0">
                                    <li class="breadcrumb-item"><a href="{{ 'dashboard' }}">Dashboards</a></li>
                                    <li class="breadcrumb-item active">Category List</li>
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
                                {{-- <h5 class="card title">Permissions List</h5> --}}
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

                                <a href="{{ route('categories.create') }}" class="btn btn-primary mb-3 ms-auto">Create
                                    Category</a>

                                <table class="table table-bordered">
                                    <tr>
                                        <th>Category Name</th>
                                        <th>Created At</th>
                                        <th>Action </th>
                                    </tr>
                                    @if ($categories->isEmpty())
                                        <tr>
                                            <td colspan="3" class="text-center">No Category found</td>
                                        </tr>
                                    @endif
                                    @foreach ($categories as $category)
                                        <tr>
                                            <td>{{ $category->name }}</td>
                                            <td>{{ \Carbon\Carbon::parse($category->created_at)->format('d M, Y') }}</td>
                                            <td>
                                                <form action="{{ route('categories.edit', $category->id) }}" method="GET"
                                                    style="display:inline-block;">
                                                    <button type="submit" class="btn btn-primary">Edit</button>
                                                </form>
                                                <form action="{{ route('categories.destroy', $category->id) }}"
                                                    method="POST" style="display:inline-block; margin-right: 5px;"
                                                    class="delete-permission-form">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger">Delete</button>

                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </table>
                                {{-- <div class="d-flex justify-content-center">
                                    {{ $permissions->links() }}
                                </div> --}}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const deleteForms = document.querySelectorAll('.delete-permission-form');
            deleteForms.forEach(form => {
                form.addEventListener('submit', function(event) {
                    if (!confirm('Are you sure you want to delete this Category?')) {
                        event.preventDefault();
                    }
                });
            });
        });
    </script>

@endsection
