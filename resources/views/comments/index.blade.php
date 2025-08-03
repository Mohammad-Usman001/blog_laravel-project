@extends('admin.layout.master')
@section('content')
    <div class="main-content">
        <div class="page-content">
            <div class="container-fluid">

                <!-- Page Title -->
                <div class="row">
                    <div class="col-12">
                        <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                            <h4 class="mb-sm-0">Comment List</h4>
                            <div class="page-title-right">
                                <ol class="breadcrumb m-0">
                                    <li class="breadcrumb-item"><a href="{{ url('dashboard') }}">Dashboard</a></li>
                                    <li class="breadcrumb-item active">Comment List</li>
                                </ol>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Flash messages -->
                @if (session('success'))
                    <div class="alert alert-success">{{ session('success') }}</div>
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

                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">

                                <!-- Bulk Delete Form -->
                                {{-- <form action="/admin/comments/bulk-delete" id="bulkDeleteForm" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger mb-3" id="bulkDeleteButton" disabled>Delete
                                        Selected</button> --}}
                                    <table class="table table-bordered">
                                        <thead>
                                            <tr>
                                                {{-- <th><input type="checkbox" id="selectAll"></th> --}}
                                                <th>Post Name</th>
                                                <th>Name</th>
                                                <th>Email</th>
                                                <th>Comment</th>
                                                <th>Status</th>
                                                <th>Comment Date</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($comments as $comment)
                                                <tr>
                                                    {{-- <td><input type="checkbox" name="selected_blogs[]"
                                                            value="{{ $comment->id }}"></td> --}}
                                                    <td>{{ $comment->post->title }}</td>
                                                    <td>{{ $comment->guest_name }}</td>
                                                    <td>{{ $comment->guest_email ?? '-' }}</td>
                                                    <td>{{ $comment->comment }}</td>
                                                    <td>
                                                        @if ($comment->is_active)
                                                            <span style="color: green;">Approved</span>
                                                        @else
                                                            <span style="color: red;">Pending</span>
                                                        @endif
                                                    </td>
                                                    <td>{{ $comment->created_at->format('d-m-Y') }}</td>
                                                    <td>
                                                        @if (!$comment->is_active)
                                                            <button type="button" class="btn btn-secondary btn-sm mb-2"
                                                                onclick="submitInlineForm('approve-form-{{ $comment->id }}')">Approve</button>
                                                            <form id="approve-form-{{ $comment->id }}"
                                                                action="{{ route('admin.comments.approve', $comment->id) }}"
                                                                method="POST" style="display:none;">
                                                                @csrf
                                                            </form>
                                                        @endif

                                                        <button type="button" class="btn btn-danger btn-sm"
                                                            onclick="confirmDelete('delete-form-{{ $comment->id }}')">Delete</button>
                                                        <form id="delete-form-{{ $comment->id }}"
                                                            action="{{ route('admin.comments.destroy', $comment->id) }}"
                                                            method="POST" style="display:none;">
                                                            @csrf
                                                            @method('DELETE')
                                                        </form>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </form>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
  
    <script>
        function toggle(source) {
            let checkboxes = document.getElementsByName('ids[]');
            for (let checkbox of checkboxes) {
                checkbox.checked = source.checked;
            }
        }

        function confirmDelete(formId) {
            if (confirm('Are you sure you want to delete this comment?')) {
                document.getElementById(formId).submit();
            }
        }

        function submitInlineForm(formId) {
            document.getElementById(formId).submit();
        }
    </script>
    {{-- <script>
        $(document).ready(function() {
            // Initialize DataTable
            $('#BlogsTable').DataTable({
                responsive: true,
                autoWidth: false,
                columnDefs: [{
                    orderable: false,
                    targets: [0, 5] // Disable sorting on the checkbox and actions columns
                }]
            });

            const selectAllCheckbox = $('#selectAll');
            const blogCheckboxes = $('.blog-checkbox');
            const bulkDeleteButton = $('#bulkDeleteButton');

            // Handle "Select All" functionality
            selectAllCheckbox.on('change', function() {
                const isChecked = $(this).prop('checked');
                blogCheckboxes.prop('checked', isChecked);
                toggleBulkDeleteButton();
            });

            // Enable or disable the bulk delete button
            blogCheckboxes.on('change', toggleBulkDeleteButton);

            function toggleBulkDeleteButton() {
                const anyChecked = blogCheckboxes.is(':checked');
                bulkDeleteButton.prop('disabled', !anyChecked);
            }

            // Confirm bulk delete before submission
            $('#bulkDeleteForm').on('submit', function(event) {
                if (!confirm('Are you sure you want to delete the selected blogs?')) {
                    event.preventDefault();
                }
            });
        });
    </script> --}}
@endsection
