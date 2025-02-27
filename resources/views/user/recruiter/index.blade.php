@extends('admin.layouts.app')

@section('content')
<div class="container">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h1 class="h4 mt-2">Recruiter List</h1>
        <a href="{{ route('recruiters.create') }}" class="btn btn-primary mt-2">Add New Recruiter</a>
    </div>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <div class="table-responsive">
        <table class="table table-bordered table-striped">
            <thead class="table-dark">
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($recruiters as $recruiter)
                    <tr>
                        <td>{{ $recruiter->id }}</td>
                        <td>{{ $recruiter->name }}</td>
                        <td>{{ $recruiter->email }}</td>
                        <td>
                            <a href="{{ route('recruiters.show', $recruiter->id) }}" class="btn btn-sm btn-info">View</a>
                            <a href="{{ route('recruiters.edit', $recruiter->id) }}" class="btn btn-sm btn-warning">Edit</a>
                            <form action="{{ route('recruiters.destroy', $recruiter->id) }}" method="POST" style="display: inline-block;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure you want to delete this Recruiter?');">Delete</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" class="text-center">No Recruiters found.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
