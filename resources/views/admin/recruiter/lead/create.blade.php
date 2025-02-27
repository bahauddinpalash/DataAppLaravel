@extends('admin.layouts.app')

@section('content')
<div class="container">
    <h4 class="pt-2">Add New Data</h4>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('admin-recruit-leads.store') }}" method="POST">
        @csrf
        <div class="form-group mb-3">
            <label for="candidate_id">Candidate</label>
            <select name="candidate_id" id="candidate_id" class="form-control" required>
                <option value="">Select Candidate</option>
                @foreach ($candidates as $candidate)
                    <option value="{{ $candidate->id }}">{{ $candidate->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group mb-3">
            <label for="lead_status">Status</label>
            <input 
                type="text" 
                name="lead_status" 
                id="lead_status" 
                class="form-control" 
                value="{{ old('lead_status') }}" 
                required
            >
        </div>
        <div class="form-group mb-3">
            <label for="candidate_meeting">Meeting Date</label>
            <input 
                type="datetime-local" 
                name="candidate_meeting" 
                id="candidate_meeting" 
                class="form-control" 
                value="{{ old('candidate_meeting') }}"
            >
        </div>
        <div class="form-group mb-3">
            <label for="remark">Remark</label>
            <textarea 
                name="remark" 
                id="remark" 
                class="form-control"
            >{{ old('remark') }}</textarea>
        </div>
        <div class="d-flex">
            <button type="submit" class="btn btn-primary mr-2">Submit</button>
            <a href="{{ route('admin-recruit-leads.index') }}" class="btn btn-secondary">Cancel</a>
        </div>
    </form>
</div>
@endsection
