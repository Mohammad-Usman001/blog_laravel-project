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
                            <h4 class="mb-sm-0">Like List</h4>

                            <div class="page-title-right">
                                <ol class="breadcrumb m-0">
                                    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboards</a></li>
                                    <li class="breadcrumb-item active">Like List</li>
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


                                <table class="table table-bordered">
                                    <tr>
                                        <th>Post Name</th>
                                        
                                        
                                        <th>IP</th>
                                        <th>Like Date</th>
                                        <th>Action</th>
                                    </tr>
                                    @foreach ($likes as $like)
                                        <tr>
                                            <td>{{ $like->post->title }}</td>

                                            <td>
                                                {{ $like->guest_ip }}
                                            </td>
                                            
                                            
                                           
                                            <td>{{ $like->created_at->format('d-m-Y') }}</td>

                                            <td>
                                                @can('delete Likes')
                                                <form action="{{ route('like.destroy', $like->id) }}"
                                                    method="POST" style="display:inline;">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger delete-comment"
                                                        onclick="return confirm('Delete this comment?')">Delete</button>
                                                </form>
                                                @endcan
                                            </td>
                                        </tr>
                                    @endforeach
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
@endsection
