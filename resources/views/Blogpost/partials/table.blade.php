<table class="table table-bordered">
    <thead>
        <tr>
            <th>Blog Title</th>
            <th>Image</th>
            <th>Category</th>
            <th>Created At</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($blogposts as $blogpost)
            <tr>
                <td>{{ $blogpost->title }}</td>
                <td>
                    @if ($blogpost->image)
                        <img src="{{ asset('storage/' . $blogpost->image) }}" width="200" height="100">
                    @else
                        <span>No image uploaded</span>
                    @endif
                </td>
                <td>{{ $blogpost->category->name ?? 'Uncategorized' }}</td>
                <td>{{ $blogpost->created_at->format('d-m-Y') }}</td>
                <td>
                    @can('Edit Blogs')
                    <a href="{{ route('blogs.edit', $blogpost->id) }}" class="btn btn-warning">Edit</a>
                    @endcan
                    @can('Delete Blogs')
                    <form action="{{ route('blogs.destroy', $blogpost->id) }}" method="POST"
                        class="delete-article-form d-inline-block ms-1">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Delete</button>
                    </form>
                    @endcan
                </td>
            </tr>
        @endforeach
    </tbody>
</table>

<div class="mt-3">
    {!! $blogposts->appends(request()->except('page'))->links() !!}
</div>
