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
                            <h4 class="mb-sm-0">Permissions List</h4>

                            <div class="page-title-right">
                                <ol class="breadcrumb m-0">
                                    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboards</a></li>
                                    <li class="breadcrumb-item active">Permissions List</li>
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
                                {{-- <div class="search-container">
                                    <input type="text" id="search" class="form-control"
                                        placeholder="Search Permission..." style="width:400px "><i
                                        class="fas fa-search search-icon"></i>
                                </div> --}}
                                <div class="row mb-3">
                                    <div class="col-md-5">
                                        <div class="search-container">
                                            <input type="text" id="search" class="form-control search-input"
                                                placeholder="Search Permission...">
                                            <i class="fas fa-search search-icon"></i>
                                        </div>
                                    </div>
                                </div>
                                @can('create permissions')
                                    <a href="{{ route('permission.create') }}" class="btn btn-primary mb-3">Create
                                        Permission</a>
                                @endcan

                                <div id="permission-table">
                                    @include('permission.table')
                                </div>


                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <style>
        img,
        svg {
            vertical-align: middle;
            margin-top: 3px;
            width: 80px;
            height: 43px;
        }

        p {
            margin-top: 20px;
            margin-bottom: 1rem;
        }

        .search-container {
            position: relative;
        }

        .search-input {
            height: 50px;
            border-radius: 30px;
            padding-left: 35px;
            border: none;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .search-icon {
            position: absolute;
            top: 50%;
            left: 15px;
            transform: translateY(-50%);
            color: #888;
        }
    </style>
    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const deleteForms = document.querySelectorAll('.delete-permission-form');
            deleteForms.forEach(form => {
                form.addEventListener('submit', function(event) {
                    if (!confirm('Are you sure you want to delete this permission?')) {
                        event.preventDefault();
                    }
                });
            });
        });
    </script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#search').on('keyup', function() {
                let search = $(this).val();

                $.ajax({
                    url: "{{ route('permissions.index') }}",
                    method: "GET",
                    data: {
                        search: search
                    },
                    success: function(response) {
                        $('#permission-table').html(response.html);
                    },
                    error: function() {
                        alert('Failed to fetch data.');
                    }
                });
            });

            // Optional: handle pagination links
            $(document).on('click', '#permission-table .pagination a', function(e) {
                e.preventDefault();
                let url = $(this).attr('href');
                let search = $('#search').val();

                $.ajax({
                    url: url,
                    data: {
                        search: search
                    },
                    success: function(response) {
                        $('#permission-table').html(response.html);
                    }
                });
            });
        });
    </script>




@endsection
