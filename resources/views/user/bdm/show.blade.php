@extends('admin.layouts.app') <!-- Using the admin-specific layout -->

@section('content')
<div class="container">
    <h1 class="h4 pt-2">BDM Details</h1>

    <div class="card mt-3">
        <div class="card-body">
            <h5 class="card-title"><strong>Name:</strong> {{ $bdm->name }}</h5>
            <p class="card-text"><strong>Email:</strong> {{ $bdm->email }}</p>
            <p class="card-text"><strong>Created At:</strong> {{ $bdm->created_at->format('d M Y, h:i A') }}</p>
            <p class="card-text"><strong>Updated At:</strong> {{ $bdm->updated_at->format('d M Y, h:i A') }}</p>
        </div>
    </div>

    <div class="mt-3">
        <a href="{{ route('bdms.index') }}" class="btn btn-secondary">Back to List</a>
        <a href="{{ route('bdms.edit', $bdm->id) }}" class="btn btn-primary">Edit</a>
        <form action="{{ route('bdms.destroy', $bdm->id) }}" method="POST" class="d-inline-block" onsubmit="return confirm('Are you sure you want to delete this BDM?');">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-danger">Delete</button>
        </form>
    </div>
</div>
@endsection
