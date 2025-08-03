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
                            <h4 class="mb-sm-0">Blog List</h4>

                            <div class="page-title-right">
                                <ol class="breadcrumb m-0">
                                    <li class="breadcrumb-item"><a href="{{ 'dashboard' }}">Dashboards</a></li>
                                    <li class="breadcrumb-item active">Blog List</li>
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
                                
                                <input type="text" id="search"
                                    class="form-control mb-3" placeholder="Search blog title or category or date & month..."
                                    style="width:400px ">
                                {{-- <div id="blog-table">
                                    @include('Blogpost.partials.table')
                                </div> --}}

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

                                <a href="{{ route('blogs.create') }}" class="btn btn-primary mb-3 ms-auto">Create
                                    Blog</a>
                                <div id="blog-table">
                                    @include('Blogpost.partials.table')
                                </div>


                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{-- <script>
        document.addEventListener('DOMContentLoaded', function() {
            const deleteForms = document.querySelectorAll('.delete-article-form');
            deleteForms.forEach(form => {
                form.addEventListener('submit', function(event) {
                    if (!confirm('Are you sure you want to delete this Blog?')) {
                        event.preventDefault();
                    }
                });
            });
        });
    </script> --}}
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            function fetch_data(query = '', page = 1) {
                $.ajax({
                    url: "{{ route('blogs.index') }}",
                    type: "GET",
                    data: {
                        search: query,
                        page: page
                    },
                    success: function(data) {
                        $('#blog-table').html(data);
                    },
                    error: function() {
                        alert("Something went wrong.");
                    }
                });
            }

            $('#search').on('keyup', function() {
                let query = $(this).val();
                fetch_data(query);
            });

            $(document).on('click', '.pagination a', function(e) {
                e.preventDefault();
                let page = $(this).attr('href').split('page=')[1];
                let query = $('#search').val();
                fetch_data(query, page);
            });

            $(document).on('submit', '.delete-article-form', function(e) {
                if (!confirm('Are you sure you want to delete this Blog?')) {
                    e.preventDefault();
                }
            });
        });
    </script>
@endsection
