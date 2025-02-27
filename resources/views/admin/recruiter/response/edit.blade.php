@extends('admin.layouts.app')

@section('content')
<div class="container">
    <h1>Edit Candidate Response</h1>
    <form action="{{ route('admin_candidate_responses.update', [$recruit_lead_id, $candidateResponse->id]) }}" method="POST">
        @csrf
        @method('PUT')
        
        <div class="mb-3">
            <label for="response_type" class="form-label">Response Type</label>
            <select name="response_type" id="response_type" class="form-control" required>
                <option value="">Select a type</option>
                @foreach ($responseTypes as $type)
                    <option value="{{ $type }}" {{ $candidateResponse->response_type === $type ? 'selected' : '' }}>{{ ucfirst($type) }}</option>
                @endforeach
            </select>
        </div>
        
        <div class="mb-3">
            <label for="response_description" class="form-label">Description</label>
            <textarea name="response_description" id="response_description" class="form-control" rows="4">{{ old('response_description', $candidateResponse->response_description) }}</textarea>
        </div>
        
        <button type="submit" class="btn btn-success">Update</button>
        <a href="{{ route('admin_candidate_responses.index', $recruit_lead_id) }}" class="btn btn-secondary">Cancel</a>
    </form>
</div>
@endsection
