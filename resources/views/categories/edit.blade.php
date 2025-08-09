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
                            <h4 class="mb-sm-0">Edit Category</h4>

                            <div class="page-title-right">
                                <ol class="breadcrumb m-0">
                                    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboards</a></li>
                                    <li class="breadcrumb-item active">Edit Category</li>
                                </ol>
                            </div>

                        </div>
                    </div>
                </div>
                <!-- end page title -->
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <form action="{{route('categories.update', $category->id)}}" method="post" >
                                @csrf
                                @method('PUT')
                                <input type="hidden" name="id" value="{{$category->id}}">
                                <div class="card-body">
                                    <h5 class="card-title">Edit Category</h5>
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
                                        
                                        <input type="text" class="form-control" id="PermissionName" name="name" placeholder="Enter Category name" value="{{ $category->name }}">
                                    </div>

                                    <button type="submit" class="btn btn-primary">Update Category</button>
                                    <button type="submit" class="btn btn-secondary ms-2">
                                        <a href="{{ route('categories.index') }}" class="text-white">
                                        Back</a></button>
                                </div>

                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
