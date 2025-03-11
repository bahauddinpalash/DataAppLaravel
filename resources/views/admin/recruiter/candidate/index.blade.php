@extends('admin.layouts.app')

@section('content')
<div class="container">
    <div class="d-flex justify-content-between align-items-center mb-1">
        <h1 class="h4 mt-2">Candidates List</h1>
        @can('candidate-create')
            <a href="{{ route('admin-candidates.create') }}" class="btn btn-primary mt-2">Add New Candidate</a>
        @endcan
    </div>

    <div class="row mb-2">
        <!-- Filter by Position -->
        <div class="col-md-4">
            <form method="GET" action="{{ route('admin-candidates.index') }}">
                <input type="hidden" name="created_by" value="{{ request('created_by') }}">
                <input type="hidden" name="date_filter" value="{{ request('date_filter') }}">
                <input type="hidden" name="start_date" value="{{ request('start_date') }}">
                <input type="hidden" name="end_date" value="{{ request('end_date') }}">
                <select name="position" class="form-control" onchange="this.form.submit()">
                    <option value="">All Positions</option>
                    @foreach($positions as $positionItem)
                        <option value="{{ $positionItem }}" {{ $positionItem == $position ? 'selected' : '' }}>
                            {{ $positionItem }}
                        </option>
                    @endforeach
                </select>
            </form>
        </div>
    
        <!-- Filter by Created By -->
        <div class="col-md-4">
            <form method="GET" action="{{ route('admin-candidates.index') }}">
                <input type="hidden" name="position" value="{{ request('position') }}">
                <input type="hidden" name="date_filter" value="{{ request('date_filter') }}">
                <input type="hidden" name="start_date" value="{{ request('start_date') }}">
                <input type="hidden" name="end_date" value="{{ request('end_date') }}">
                <select name="created_by" class="form-control" onchange="this.form.submit()">
                    <option value="">All Creators</option>
                    @foreach($creators as $creator)
                        <option value="{{ $creator }}" {{ $creator == $createdBy ? 'selected' : '' }}>
                            {{ $creator }}
                        </option>
                    @endforeach
                </select>
            </form>
        </div>
    
        <!-- Filter by Date Range -->
        <div class="col-md-4">
            <form method="GET" action="{{ route('admin-candidates.index') }}">
                <input type="hidden" name="position" value="{{ request('position') }}">
                <input type="hidden" name="created_by" value="{{ request('created_by') }}">
                <select name="date_filter" class="form-control" onchange="this.form.submit()">
                    <option value="">All Dates</option>
                    <option value="today" {{ 'today' == $dateFilter ? 'selected' : '' }}>Today</option>
                    <option value="week" {{ 'week' == $dateFilter ? 'selected' : '' }}>This Week</option>
                    <option value="month" {{ 'month' == $dateFilter ? 'selected' : '' }}>This Month</option>
                    <option value="custom" {{ 'custom' == $dateFilter ? 'selected' : '' }}>Custom Date Range</option>
                </select>
    
                <!-- Custom Date Range Fields -->
                @if(request('date_filter') == 'custom')
                    <div class="row mt-2">
                        <div class="col-md-6">
                            <input type="date" name="start_date" class="form-control" value="{{ request('start_date') }}">
                        </div>
                        <div class="col-md-6">
                            <input type="date" name="end_date" class="form-control" value="{{ request('end_date') }}">
                        </div>
                    </div>
                    <div class="mt-2">
                        <button type="submit" class="btn btn-primary btn-sm">Apply</button>
                    </div>
                @endif
            </form>
        </div>
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
                            @can('candidate-list')
                                <a href="{{ route('admin-candidates.show', $candidate->id) }}" class="btn btn-sm btn-info">View</a>
                            @endcan
                            @can('candidate-edit')
                                <a href="{{ route('admin-candidates.edit', $candidate->id) }}" class="btn btn-sm btn-warning">Edit</a>
                            @endcan
                            @can('candidate-delete')
                                <form action="{{ route('admin-candidates.destroy', $candidate->id) }}" method="POST" style="display: inline-block;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure you want to delete this Candidate?');">Delete</button>
                                </form>
                            @endcan
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" class="text-center">No Candidates found.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
        {{ $candidates->links() }}
    </div>
</div>
@endsection
