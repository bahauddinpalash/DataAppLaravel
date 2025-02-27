@extends('admin.layouts.app')

@section('content')
<div class="container">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h4 class="h4 mt-2">Recruit Activities for Lead: #{{ $lead->id }} ({{ $lead->candidate->name }})</h4>
        <a href="{{ route('admin_recruit_activities.create', $recruit_lead_id) }}" class="btn btn-primary">Add New Activity</a>
    </div>

    @if (session('success'))
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
                    <th>Updated By</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($activities as $activity)
                    <tr>
                        <td>{{ $activity->id }}</td>
                        <td class="text-capitalize">{{ $activity->activity_type }}</td>
                        <td>{{ $activity->activity_description }}</td>
                        <td>
                            <strong>{{ $activity->created_by }}</strong>
                            <br>
                            <small class="text-muted">{{ $activity->created_at->format('d M Y, h:i A') }}</small>
                        </td>
                        <td>
                            @if ($activity->updated_by)
                                <strong>{{ $activity->updated_by }}</strong>
                                <br>
                                <small class="text-muted">{{ $activity->updated_at->format('d M Y, h:i A') }}</small>
                            @else
                                <span class="text-muted">N/A</span>
                            @endif
                        </td>
                        <td class="text-center">
                           
                                <a href="{{ route('admin_recruit_activities.edit', ['recruit_lead_id' => $recruit_lead_id, 'id' => $activity->id]) }}" class="btn btn-warning btn-sm"><i class="fas fa-edit"></i></a>
                                <form action="{{ route('admin_recruit_activities.destroy', ['recruit_lead_id' => $recruit_lead_id, 'activity_id' => $activity->id]) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure?')">
                                        <i class="fas fa-trash-alt"></i>
                                    </button>
                                </form>
                            
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="text-center">No activities found for this lead.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
