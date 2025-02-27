@extends('recruiter.layouts.app')

@section('content')
<div class="container">
    <h1>Recruit Activities for Lead: {{ $lead->id }}</h1>
    <a href="{{ route('recruit_activities.create', $recruit_lead_id) }}" class="btn btn-primary">Add New Activity</a>
    
    <div class="mt-3">
        <table class="table table-bordered">
            <thead>
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
                @foreach($activities as $activity)
                <tr>
                    <td>{{ $activity->id }}</td>
                    <td>{{ $activity->activity_type }}</td>
                    <td>{{ $activity->activity_description }}</td>
                    <td>
                        {{ $activity->created_by }}
                        <br>
                        <small class="text-muted">{{ $activity->created_at->format('d M Y, h:i A') }}</small>
                    </td>
                    <td>
                        {{ $activity->updated_by ?? 'N/A' }}
                        @if ($activity->updated_by)
                            <br>
                            <small class="text-muted">{{ $activity->updated_at->format('d M Y, h:i A') }}</small>
                        @endif
                    </td>
                    <td>
                        <a href="{{ route('recruit_activities.edit', ['recruit_lead_id' => $recruit_lead_id, 'id' => $activity->id]) }}" class="btn btn-warning btn-sm">Edit</a>
                        <form action="{{ route('recruit_activities.destroy', ['recruit_lead_id' => $recruit_lead_id, 'activity_id' => $activity->id]) }}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure?')">Delete</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
