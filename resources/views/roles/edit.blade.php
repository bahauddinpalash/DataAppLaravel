@extends('admin.layouts.app')

@section('content')
<div class="container mt-4">
    <h1 class="mb-4">Edit Role</h1>
    <form action="{{ route('roles.update', $role->id) }}" method="POST">
        @csrf
        @method('PUT')
        
        <!-- Role Name -->
        <div class="form-group mb-3">
            <label for="name">Role Name</label>
            <input type="text" name="name" id="name" class="form-control" 
                   value="{{ old('name', $role->name) }}" required>
            @error('name')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>
        
        <!-- Permissions -->
        <div class="form-group mb-3">
            <label for="permissions">Permissions</label>
            <div class="form-check">
                @foreach ($permissions as $permission)
                    <div>
                        <input type="checkbox" name="permissions[]" 
                               id="permission-{{ $permission->id }}" 
                               value="{{ $permission->id }}" 
                               class="form-check-input"
                               {{ $role->permissions->pluck('id')->contains($permission->id) ? 'checked' : '' }}>
                        <label for="permission-{{ $permission->id }}" class="form-check-label">
                            {{ $permission->name }}
                        </label>
                    </div>
                @endforeach
            </div>
            @error('permissions')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>
        
        <!-- Buttons -->
        <button type="submit" class="btn btn-primary">Update Role</button>
        <a href="{{ route('roles.index') }}" class="btn btn-secondary">Cancel</a>
    </form>
    
</div>
@endsection
