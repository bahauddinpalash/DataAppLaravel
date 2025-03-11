@extends('admin.layouts.app')

@section('content')
<div class="container">
    <h4 class="mb-4 pt-4">Roles</h4>
    @can('role-create')
    <a href="{{ route('roles.create') }}" class="btn btn-primary mb-3">Create New Role</a>
    @endcan
    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>#</th>
                <th>Name</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($roles as $role)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $role->name }}</td>
                    <td>
                        @can('role-list')
                        <a href="{{ route('roles.show', $role->id) }}" class="btn btn-info btn-sm">View</a>
                        @endcan
                        @can('role-edit')
                        <a href="{{ route('roles.edit', $role->id) }}" class="btn btn-warning btn-sm">Edit</a>
                        @endcan
                        @can('role-delete')
                        <form action="{{ route('roles.destroy', $role->id) }}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure?')">Delete</button>
                        </form>
                        @endcan
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="3">No roles found.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
