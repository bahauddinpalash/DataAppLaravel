@extends('admin.layouts.app') <!-- Using the admin-specific layout -->

@section('content')
<div class="container">
    <h1 class="h4 pt-2">Recruiter Details</h1>

    <div class="card mt-3">
        <div class="card-body">
            <h5 class="card-title"><strong>Name:</strong> {{ $recruiter->name }}</h5>
            <p class="card-text"><strong>Email:</strong> {{ $recruiter->email }}</p>
            <p class="card-text"><strong>Created At:</strong> {{ $recruiter->created_at->format('d M Y, h:i A') }}</p>
            <p class="card-text"><strong>Updated At:</strong> {{ $recruiter->updated_at->format('d M Y, h:i A') }}</p>
        </div>
    </div>

    <div class="mt-3">
        <a href="{{ route('recruiters.index') }}" class="btn btn-secondary">Back to List</a>
        <a href="{{ route('recruiters.edit', $recruiter->id) }}" class="btn btn-primary">Edit</a>
        <!-- Optional Delete Form for Recruiter, if needed -->
        <form action="{{ route('recruiters.destroy', $recruiter->id) }}" method="POST" class="d-inline-block" onsubmit="return confirm('Are you sure you want to delete this Recruiter?');">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-danger">Delete</button>
        </form>
    </div>
</div>
@endsection
