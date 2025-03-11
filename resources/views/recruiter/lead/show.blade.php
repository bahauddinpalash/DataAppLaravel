@extends('recruiter.layouts.app')

@section('content')
<div class="container">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h4 class="h4 mt-2">Data Details</h4>
        <a href="{{ route('leads.index') }}" class="btn btn-secondary mt-2">Back to List</a>
    </div>

    <div class="card">
        <div class="card-header bg-primary text-white">
            <h4>{{ $lead->candidate->name }}</h4>
        </div>
        <div class="card-body">
            <p><strong>ID:</strong> {{ $lead->id }}</p>
            <p><strong>Status:</strong> {{ ucfirst($lead->lead_status) }}</p>
            <p><strong>Position:</strong> {{ $lead->position }}</p>
            <p><strong>Meeting Date:</strong> 
                {{ $lead->candidate_meeting ? \Carbon\Carbon::parse($lead->candidate_meeting)->format('Y-m-d H:i') : 'Not Scheduled' }}
            </p>
            <p><strong>Remark:</strong> {{ $lead->remark }}</p>

            <hr>

            <p><strong>Created By:</strong> {{ $lead->created_by }}</p>
            <p><strong>Created At:</strong> {{ $lead->created_at->format('Y-m-d H:i:s') }}</p>
            
            @if ($lead->updated_by)
                <p><strong>Updated By:</strong> {{ $lead->updated_by }}</p>
                <p><strong>Updated At:</strong> {{ $lead->updated_at->format('Y-m-d H:i:s') }}</p>
            @endif
        </div>
        <div class="card-footer d-flex">
            <a href="{{ route('leads.edit', $lead->id) }}" class="btn btn-warning mr-2">Edit</a>
            {{-- <form action="{{ route('leads.destroy', $lead->id) }}" method="POST" style="display:inline-block;">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this lead?');">Delete</button>
            </form> --}}
        </div>
    </div>
</div>
@endsection
