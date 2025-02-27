@extends('bdm.layouts.app')   
@section('content')
    <div class="container mt-5">
        <h1>Sales Activities for Lead: {{ $lead->client->client_name }}</h1>
        <a href="{{ route('sales_activities.create', $lead->id) }}" class="btn btn-success mb-3">Add New Activity</a>

        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Activity Type</th>
                    <th>Activity Description</th>
                    {{-- <th>Activity Date</th> --}}
                    <th>Created By</th>
                    <th>Updated By</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($activities as $activity)
                    <tr>
                        <td>{{ $activity->id }}</td>
                        <td>{{ ucfirst($activity->activity_type) }}</td>
                        <td>{{ $activity->activity_description }}</td>
                        {{-- <td>{{ $activity->created_at->format('d/m/Y H:i') }}</td> --}}
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
                            <a href="{{ route('sales_activities.edit', ['bdm_lead_id' => $activity->bdm_lead_id, 'sales_activity' => $activity->id]) }}" class="btn btn-warning btn-sm">Edit</a>

                            <form action="{{ route('sales_activities.destroy', ['bdm_lead_id' => $activity->bdm_lead_id, 'sales_activity' => $activity->id]) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this sales activity?')">
                                    Delete
                                </button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
