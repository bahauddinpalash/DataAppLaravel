@extends('bdm.layouts.app')   
@section('content')

    <div class="container mt-5">
        <h1>Client Responses for Lead: {{ $lead->client->client_name }}</h1>
        
        <a href="{{ route('response.create', $lead->id) }}" class="btn btn-primary mb-3">Add Response</a>

        @if($responses->isEmpty())
            <div class="alert alert-info">No client responses found for this lead.</div>
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
                            <td>{{ ucfirst($response->response_type) }}</td>
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
                                <a href="{{ route('response.edit', ['bdm_lead_id' => $response->bdm_lead_id, 'response_id' => $response->id])}}" class="btn btn-warning btn-sm">Edit</a>
                                <form action="{{ route('response.destroy', ['bdm_lead_id' => $bdm_lead_id, 'response_id' => $response->id]) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this response?')">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endif
    </div>
@endsection
