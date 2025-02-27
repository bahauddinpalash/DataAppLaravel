@extends('admin.layouts.app')

@section('content')
<div class="container">
    <h1>Candidate Responses for Lead: {{ $lead->id }}</h1>
    <a href="{{ route('admin_candidate_responses.create', $recruit_lead_id) }}" class="btn btn-primary mb-3">Add Response</a>
    
    @if ($responses->isEmpty())
        <p>No responses available.</p>
    @else
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Response Type</th>
                    <th>Description</th>
                    <th>Received By</th>
                    <th>Updated By</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($responses as $response)
                    <tr>
                        <td>{{ $response->id }}</td>
                        <td>{{ $response->response_type }}</td>
                        <td>{{ $response->response_description }}</td>
                        <td>
                            {{ $response->received_by }}
                            <br>
                            <small class="text-muted">{{ $response->created_at->format('d M Y, h:i A') }}</small>
                        </td>
                        <td>
                            {{ $response->updated_by ?? 'N/A' }}
                            @if ($response->updated_by)
                                <br>
                                <small class="text-muted">{{ $response->updated_at->format('d M Y, h:i A') }}</small>
                            @endif
                        </td>
                        <td>
                            <a href="{{ route('admin_candidate_responses.edit', [$recruit_lead_id, $response->id]) }}" class="btn btn-sm btn-warning">Edit</a>
                            <form action="{{ route('admin_candidate_responses.destroy', [$recruit_lead_id, $response->id]) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure?')">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif
</div>
@endsection
