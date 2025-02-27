@extends('admin.layouts.app')

@section('content')
<div class="container">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h4 class="h4 mt-2">Client Responses for Lead ID: <strong>{{ $bdm_lead_id }}</strong></h4>
        <a href="{{ route('client-response.create', $bdm_lead_id) }}" class="btn btn-primary mt-2">Add New Response</a>
    </div>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif
    @if($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <div class="table-responsive">
        <table class="table table-bordered table-striped">
            <thead class="table-dark">
                <tr>
                    <th>ID</th>
                    <th>Response Type</th>
                    <th>Description</th>
                    <th>Received By</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($responses as $response)
                    <tr>
                        <td>{{ $response->id }}</td>
                        <td>{{ ucfirst($response->response_type) }}</td>
                        <td>{{ $response->response_description }}</td>
                        <td>{{ $response->received_by }}</td>
                        <td>
                            <a href="{{ route('client-response.edit', ['bdm_lead_id' => $bdm_lead_id, 'response_id' => $response->id]) }}" class="btn btn-sm btn-warning me-2 mb-1">Edit</a>
                            <form action="{{ route('client-response.destroy', ['bdm_lead_id' => $bdm_lead_id, 'response_id' => $response->id]) }}" method="POST" style="display:inline-block;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger mb-1" onclick="return confirm('Are you sure you want to delete this response?');">Delete</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="text-center">No Responses found.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
