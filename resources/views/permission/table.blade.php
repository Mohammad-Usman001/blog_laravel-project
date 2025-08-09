<table class="table table-bordered">
    <thead>
        <tr>
            <th>Permission Name</th>
            <th>Created At</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        @if ($permissions->isEmpty())
            <tr>
                <td colspan="3" class="text-center">No permissions found</td>
            </tr>
        @else
            @foreach ($permissions as $permission)
                <tr>
                    <td>{{ $permission->name }}</td>
                    <td>{{ \Carbon\Carbon::parse($permission->created_at)->format('d M, Y') }}</td>
                    <td>
                        @can('delete permissions')
                            <form action="{{ route('permission.destroy', $permission->id) }}" method="POST"
                                style="display:inline-block; margin-right: 5px;" class="delete-permission-form">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">Delete</button>
                            </form>
                        @endcan
                        @can('edit permissions')
                            <form action="{{ route('permission.edit', $permission->id) }}" method="GET"
                                style="display:inline-block;">
                                <button type="submit" class="btn btn-primary">Edit</button>
                            </form>
                        @endcan
                    </td>
                </tr>
            @endforeach
        @endif
    </tbody>
</table>
<div class="d-flex justify-content-center">
    {{ $permissions->links() }}
</div>
