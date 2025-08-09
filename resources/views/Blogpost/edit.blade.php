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
                            <h4 class="mb-sm-0">Edit Blog Post</h4>

                            <div class="page-title-right">
                                <ol class="breadcrumb m-0">
                                    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboards</a></li>
                                    <li class="breadcrumb-item active">Edit Blog Post</li>
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
                                <form action="{{ route('blogs.update', $blogpost->id) }}" method="POST"
                                    enctype="multipart/form-data">
                                    @csrf
                                    @method('PUT')
                                    <div class="mb-3">
                                        <label for="category_id" class="form-label">Category</label>
                                        <select name="category_id" id="category_id" class="form-control" required>
                                            <option value="">-- Select Category --</option>
                                            @foreach ($categories as $category)
                                                <option value="{{ $category->id }}"
                                                    {{ old('category_id', $blogpost->category_id) == $category->id ? 'selected' : '' }}>
                                                    {{ $category->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="mb-3">
                                        <label for="title" class="form-label">Title</label>
                                        <input type="text" name="title" class="form-control"
                                            value="{{ $blogpost->title }}" required>
                                    </div>

                                    <div class="mb-3">
                                        <label for="slug" class="form-label">Slug</label>
                                        <input type="text" name="slug" class="form-control"
                                            value="{{ $blogpost->slug }}" readonly>
                                    </div>

                                    <div class="mb-3">
                                        <label for="short_description" class="form-label">Short Description</label>
                                        <textarea name="short_description" class="form-control" rows="3" required>{{ $blogpost->short_description }}</textarea>
                                    </div>



                                    <div class="mb-3">
                                        <label for="content" class="form-label">Content</label>
                                        {{-- <div class="ckeditor-classic"></div> --}}
                                        <textarea name="content" id="editor">{{ $blogpost->content }}</textarea>
                                    </div>


                                    <div class="mb-3">
                                        <label for="image" class="form-label">Image</label>
                                        <input type="file" name="image" class="form-control" accept="image/*">
                                        <small class="text-muted">Allowed types: jpg, jpeg, png, gif. Max size: 3MB.</small>
                                    </div>
                                    <img src="{{ asset('storage/' . $blogpost->image) }}" alt="{{ $blogpost->title }}"
                                        width="200" height="100">
                                    <hr>


                                    <div class="mb-3">
                                        <label for="Seo_Information" class="form-label"
                                            style="font-size: 15px; font-weight: 800;">SEO
                                            Information</label><br>
                                        <label for="meta_title" class="form-label">Meta Title</label>
                                        <input type="text" name="meta_title" class="form-control"
                                            value="{{ $blogpost->meta_title }}">
                                    </div>

                                    <div class="mb-3">
                                        <label for="meta_description" class="form-label">Meta Description</label>
                                        <textarea name="meta_description" class="form-control" rows="2">{{ $blogpost->meta_description }}</textarea>
                                    </div>



                                    <div class="d-flex">
                                        <button type="submit" class="btn btn-primary">Update Blog Post</button>
                                        <a href="{{ route('blogs.index') }}" class="btn btn-secondary ms-2">Back to
                                            List</a>
                                    </div>
                            </div>
                        </div>
                        {{-- <div class="card col-6">
                            <div class="card-body">
                                <label for="Seo_Information" class="form-label">SEO Information</label>
                                
                            </div>
                        </div> --}}
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
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const titleInput = document.querySelector('input[name="title"]');
            const slugInput = document.querySelector('input[name="slug"]');

            titleInput.addEventListener('input', function() {
                let slug = titleInput.value.toLowerCase()
                    .replace(/[^a-z0-9\s-]/g, '') // Remove special chars
                    .replace(/\s+/g, '-') // Replace spaces with hyphens
                    .replace(/-+/g, '-'); // Collapse multiple hyphens
                slugInput.value = slug;
            });
        });
    </script>
    <!-- Include CKEditor JS -->
    <script src="https://cdn.ckeditor.com/ckeditor5/39.0.1/classic/ckeditor.js"></script>

    {{-- <script>
    document.addEventListener('DOMContentLoaded', function () {
        const editorEl = document.querySelector('.ckeditor-classic');
        if (editorEl) {
            ClassicEditor
                .create(editorEl)
                .catch(error => {
                    console.error('CKEditor init error:', error);
                });
        }
    });
</script> --}}
    <script>
        ClassicEditor
            .create(document.querySelector('#editor'))
            .catch(error => {
                console.error(error);
            });
    </script>




@endsection
