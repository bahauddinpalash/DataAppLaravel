@extends('bdm.layouts.app')

@section('content')
<div class="container">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h1 class="h4 mt-2">Client Details</h1>
        <a href="{{ route('clients.index') }}" class="btn btn-secondary mt-2">Back to List</a>
    </div>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <div class="card">
        <div class="card-header bg-info text-white">
            <h4>{{ $client->client_name }}</h4>
        </div>
        <div class="card-body">
            <p><strong>Address:</strong> {{ $client->address }}</p>
            <p><strong>Client Service Number:</strong> {{ $client->client_service_number }}</p>
            <p><strong>Remarks:</strong> {{ $client->remarks }}</p>

            @if ($client->logo)
                <p><strong>Logo:</strong></p>
                <img src="{{ asset('storage/' . $client->logo) }}" alt="Logo" class="img-thumbnail" width="100">
            @endif

            <div class="mb-3 mt-4">
                <strong>Created By:</strong> {{ $client->created_by }}
            </div>

            <div class="mb-3">
                <strong>Created At:</strong> {{ $client->created_at->format('Y-m-d H:i:s') }}
            </div>

            @if ($client->updated_by)
                <div class="mb-3">
                    <strong>Updated By:</strong> {{ $client->updated_by }}
                </div>
                <div class="mb-3">
                    <strong>Updated At:</strong> {{ $client->updated_at->format('Y-m-d H:i:s') }}
                </div>
            @endif
        </div>

        <div class="card-footer d-flex">
            <a href="{{ route('clients.edit', $client->id) }}" class="btn btn-warning" style="margin-right: 5px;">Edit</a>
            <form action="{{ route('clients.destroy', $client->id) }}" method="POST" style="display:inline-block;">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this Client?');">Delete</button>
            </form>
        </div>
    </div>
</div>
@endsection