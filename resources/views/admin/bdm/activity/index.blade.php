@extends('admin.layouts.app')

@section('content')
<div class="container">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h4 class="h4 mt-2">BDM Activities for Lead ID:<strong> {{ $lead->id }}</strong></h4>
        <a href="{{ route('bdm-activities.create', $lead->id) }}" class="btn btn-primary mt-2">Add New Activity</a>
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
                    <th>Activity Type</th>
                    <th>Description</th>
                    <th>Created By</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($activities as $activity)
                    <tr>
                        <td>{{ $activity->id }}</td>
                        <td>{{ ucfirst($activity->activity_type) }}</td>
                        <td>{{ $activity->activity_description }}</td>
                        <td>{{ $activity->created_by }}</td>
                        <td>
                            {{-- <a href="{{ route('bdm-activities.show', [$lead->id, $activity->id]) }}" class="btn btn-sm btn-info me-2 mb-1">View</a> --}}
                            <a href="{{ route('bdm-activities.edit', [$lead->id, $activity->id]) }}" class="btn btn-sm btn-warning me-2 mb-1">Edit</a>
                            <form action="{{ route('bdm-activities.destroy', [$lead->id, $activity->id]) }}" method="POST" style="display:inline-block;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger mb-1" onclick="return confirm('Are you sure you want to delete this activity?');">Delete</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="text-center">No Activities found.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
