@extends('admin.layouts.app')

@section('content')
<div class="container">
    <h4 class="mb-4 pt-3">Role Details</h4>
    <div class="mb-3"> 
        <h5>Name: {{ $role->name }}</h5>
    </div>
    <div class="mb-3">
        <h5>Permissions:</h5>
        <ul>
            @forelse ($role->permissions as $permission)
                <li>{{ $permission->name }}</li>
            @empty
                <p>No permissions assigned to this role.</p>
            @endforelse
        </ul>
    </div>
    <a href="{{ route('roles.index') }}" class="btn btn-secondary">Back to Roles</a>
</div>
@endsection
