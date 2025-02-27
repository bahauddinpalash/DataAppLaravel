@extends('admin.layouts.app')

@section('content')
<div class="container">
    <h4 class="h4 mb-3 pt-3">Add Client Response for Lead ID: <strong>{{ $lead->id }}</strong></h4>
    @if($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <form action="{{ route('client-response.store', ['bdm_lead_id' => $lead->id]) }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="response_type" class="form-label">Response Type</label>
            <select name="response_type" id="response_type" class="form-control">
                @foreach($responseTypes as $type)
                    <option value="{{ $type }}">{{ ucfirst($type) }}</option>
                @endforeach
            </select>
        </div>
        <div class="mb-3">
            <label for="response_description" class="form-label">Description</label>
            <textarea name="response_description" id="response_description" class="form-control" rows="5" required></textarea>
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
        <a href="{{ route('client-response.index', ['bdm_lead_id' => $lead->id]) }}" class="btn btn-secondary">Cancel</a>
    </form>
</div>
@endsection
