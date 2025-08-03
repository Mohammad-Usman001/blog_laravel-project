@extends('admin.layout.master')

@section('content')
    <!-- start page title -->

    <!-- ============================================================== -->
    <!-- Start right Content here -->
    <!-- ============================================================== -->
    <div class="main-content">

        <div class="page-content">
            <div class="container-fluid">

                <!-- start page title -->
                <div class="row">
                    <div class="col-12">
                        <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                            <h4 class="mb-sm-0">Overview</h4>

                            <div class="page-title-right">
                                <ol class="breadcrumb m-0">
                                    <li class="breadcrumb-item"><a href="javascript: void(0);">Dashboards</a></li>
                                    <li class="breadcrumb-item active">Overview</li>
                                </ol>
                            </div>

                        </div>
                    </div>
                </div>
                <!-- end page title -->
                <div class="row">
                    <div class="col-xxl col-sm-6">
                        <div class="card overflow-hidden">
                            <div class="card-body">
                                <div class="avatar-sm float-end">
                                    <div class="avatar-title bg-primary-subtle text-primary fs-3xl rounded">
                                        <i class="ph ph-briefcase"></i>
                                    </div>
                                </div>
                                <h4><span class="counter-value" data-target="{{($BlogpostCount)}}">0</span></h4>
                                <p class="text-muted mb-4">Total Blogs</p>
                                
                            </div>
                            <div class="progress progress-sm rounded-0" role="progressbar" aria-valuenow="76"
                                aria-valuemin="0" aria-valuemax="100">
                                <div class="progress-bar" style="width: 76%"></div>
                            </div>
                        </div>
                    </div><!--end col-->
                    <div class="col-xxl col-sm-6">
                        <div class="card overflow-hidden">
                            <div class="card-body">
                                <div class="avatar-sm float-end">
                                    <div class="avatar-title bg-secondary-subtle text-secondary fs-3xl rounded">
                                        <i class="ph ph-wallet"></i>
                                    </div>
                                </div>
                                <h4><span class="counter-value" data-target="{{($categoryCount)}}">0</span></h4>
                                <p class="text-muted mb-4">Total Categories</p>
                                
                            </div>
                            <div class="progress progress-sm rounded-0" role="progressbar" aria-valuenow="88"
                                aria-valuemin="0" aria-valuemax="100">
                                <div class="progress-bar bg-secondary" style="width: 88%"></div>
                            </div>
                        </div>
                    </div><!--end col-->
                    <div class="col-xxl col-sm-6">
                        <div class="card overflow-hidden">
                            <div class="card-body">
                                <div class="avatar-sm float-end">
                                    <div class="avatar-title bg-danger-subtle text-danger fs-3xl rounded">
                                        <i class="bi bi-broadcast"></i>
                                    </div>
                                </div>
                                <h4><span class="counter-value" data-target="{{($commentCount)}}"></span></h4>
                                <p class="text-muted mb-4">Total Comment</p>
                                
                            </div>
                            <div class="progress progress-sm rounded-0" role="progressbar" aria-valuenow="18"
                                aria-valuemin="0" aria-valuemax="100">
                                <div class="progress-bar bg-danger" style="width: 18%"></div>
                            </div>
                        </div>
                    </div><!--end col-->
                    <div class="col-xxl col-sm-6">
                        <div class="card overflow-hidden">
                            <div class="card-body">
                                <div class="avatar-sm float-end">
                                    <div class="avatar-title bg-danger-subtle text-danger fs-3xl rounded">
                                        <i class="bi bi-broadcast"></i>
                                    </div>
                                </div>
                                <h4><span class="counter-value" data-target="{{($blogPostCountToday)}}"></span></h4>
                                <p class="text-muted mb-4">Today Blog Post</p>
                                
                            </div>
                            <div class="progress progress-sm rounded-0" role="progressbar" aria-valuenow="18"
                                aria-valuemin="0" aria-valuemax="100">
                                <div class="progress-bar bg-danger" style="width: 18%"></div>
                            </div>
                        </div>
                    </div><!--end col-->
                    
                @endsection
