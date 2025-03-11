@extends('admin.layouts.app')

@section('content')
<div class="container">
    <h4 class="mb-4 pt-3">Create New Role</h4>
    <form action="{{ route('roles.store') }}" method="POST">
        @csrf
        <div class="form-group mb-3">
            <label for="name">Role Name</label>
            <input type="text" name="name" id="name" class="form-control" value="{{ old('name') }}" required>
            @error('name')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>
        <div class="form-group mb-3">
            <label for="permissions">Permissions</label>
            <div class="form-check">
                @foreach ($permissions as $permission)
                    <div>
                        <input type="checkbox" name="permissions[{{ $permission->name }}]" id="permission-{{ $permission->id }}" value="{{ $permission->name }}" class="form-check-input">
                        <label for="permission-{{ $permission->id }}" class="form-check-label">{{ $permission->name }}</label>
                    </div>
                @endforeach
            </div>
            @error('permissions')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>
        <button type="submit" class="btn btn-primary">Create Role</button>
        <a href="{{ route('roles.index') }}" class="btn btn-secondary">Cancel</a>
    </form>
</div>
@endsection
