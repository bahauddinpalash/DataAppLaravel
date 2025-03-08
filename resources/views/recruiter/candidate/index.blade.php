@extends('recruiter.layouts.app')

@section('content')
<div class="container pb-2">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h1 class="h4 mt-2">Candidates List</h1>
        <a href="{{ route('candidates.create') }}" class="btn btn-primary mt-2">Add New Candidate</a>
    </div>

    <form method="GET" action="{{ route('candidates.index') }}" class="mb-3">
        <div class="row">
            <div class="col-md-4">
                <select name="position" class="form-control" onchange="this.form.submit()">
                    <option value="">All Positions</option>
                    @foreach($positions as $pos)
                        <option value="{{ $pos }}" {{ $pos == $position ? 'selected' : '' }}>{{ $pos }}</option>
                    @endforeach
                </select>
            </div>
        </div>
    </form>


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
                    <th>Contact Number</th>
                    <th>Position</th>
                    <th>Nationality</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($candidates as $candidate)
                    <tr>
                        <td>{{ $candidate->id }}</td>
                        <td>{{ Str::limit($candidate->name, 12) }}</td>
                        <td>{{ Str::limit($candidate->email, 12) }}</td>
                        <td>{{ $candidate->contact_number }}</td>
                        <td>{{ Str::limit($candidate->position, 12) }}</td>
                        <td>{{ $candidate->nationality }}</td>
                        <td>
                            <a href="{{ route('candidates.show', $candidate->id) }}" class="btn btn-sm btn-info">View</a>
                            <a href="{{ route('candidates.edit', $candidate->id) }}" class="btn btn-sm btn-warning">Edit</a>
                            <form action="{{ route('candidates.destroy', $candidate->id) }}" method="POST" style="display: inline-block;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure you want to delete this candidate?');">Delete</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" class="text-center">No candidates found.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
        {{ $candidates->links() }}
    </div>
</div>
@endsection
