@extends('admin.layouts.app')

@section('content')
<div class="container">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h4 class="h4 mt-2">Lead Details</h4>
        <a href="{{ route('admin-bdm-leads.index') }}" class="btn btn-secondary">Back to List</a>
    </div>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <div class="card">
        <div class="card-header bg-info text-white">
            <h4>{{ $lead->client->client_name }}</h4>
        </div>
        <div class="card-body">
            <p><strong>Lead Status:</strong> {{ ucfirst($lead->lead_status) }}</p>
            <p><strong>Client Meeting:</strong> {{ $lead->client_meeting ? \Carbon\Carbon::parse($lead->client_meeting)->format('Y-m-d H:i') : 'Not Scheduled' }}</p>
            <p><strong>Remark:</strong> {{ $lead->remark }}</p>

            <div class="mb-3 mt-4">
                <strong>Created By:</strong> {{ $lead->created_by }}
            </div>
    
            <div class="mb-3">
                <strong>Created At:</strong> {{ $lead->created_at->format('Y-m-d H:i:s') }}
            </div>
    
            @if ($lead->updated_by)
                <div class="mb-3">
                    <strong>Updated By:</strong> {{ $lead->updated_by }}
                </div>
                <div class="mb-3">
                    <strong>Updated At:</strong> {{ $lead->updated_at->format('Y-m-d H:i:s') }}
                </div>
            @endif
        </div>

        <div class="card-footer d-flex">
            <a href="{{ route('admin-bdm-leads.edit', $lead->id) }}" class="btn btn-warning mr-2">Edit</a>
            <form action="{{ route('admin-bdm-leads.destroy', $lead->id) }}" method="POST" style="display:inline-block;">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this lead?');">Delete</button>
            </form>
        </div>
    </div>
</div>
@endsection
