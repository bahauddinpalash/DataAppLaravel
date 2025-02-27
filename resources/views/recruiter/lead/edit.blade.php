@extends('recruiter.layouts.app')

@section('content')
<div class="container">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h4 class="pt-2">Edit Data</h4>
    </div>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('leads.update', $lead->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="form-group mb-3">
            <label for="candidate_id">Candidate</label>
            <select id="candidate_id" name="candidate_id" class="form-control" required>
                <option value="">Select Candidate</option>
                @foreach ($candidates as $candidate)
                    <option value="{{ $candidate->id }}" {{ $candidate->id == $lead->candidate_id ? 'selected' : '' }}>
                        {{ $candidate->name }}
                    </option>
                @endforeach
            </select>
        </div>
        <div class="form-group mb-3">
            <label for="lead_status">Status</label>
            <input 
                type="text" 
                id="lead_status" 
                name="lead_status" 
                class="form-control" 
                value="{{ old('lead_status', $lead->lead_status) }}" 
                required
            >
        </div>
        <div class="form-group mb-3">
            <label for="position">Position</label>
            <input 
                type="text" 
                id="position" 
                name="position" 
                class="form-control" 
                value="{{ old('position', $lead->position) }}" 
                required
            >
        </div>
        <div class="form-group mb-3">
            <label for="candidate_meeting">Meeting Date</label>
            <input 
                type="datetime-local" 
                id="candidate_meeting" 
                name="candidate_meeting" 
                class="form-control" 
                value="{{ old('candidate_meeting', $lead->candidate_meeting ? \Carbon\Carbon::parse($lead->candidate_meeting)->format('Y-m-d\TH:i') : '') }}"
            >
        </div>
        <div class="form-group mb-3">
            <label for="remark">Remark</label>
            <textarea 
                id="remark" 
                name="remark" 
                class="form-control"
            >{{ old('remark', $lead->remark) }}</textarea>
        </div>
        <div class="d-flex">
            <button type="submit" class="btn btn-primary mr-2">Update</button>
            <a href="{{ route('leads.index') }}" class="btn btn-secondary">Cancel</a>
        </div>
    </form>
</div>
@endsection
