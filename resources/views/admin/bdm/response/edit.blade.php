@extends('admin.layouts.app')

@section('content')
<div class="container">
    <h4 class="h4 pt-3 mb-3">Edit Client Response for Lead ID: <strong>{{ $bdm_lead_id }}</strong></h4>

    {{-- @if($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif --}}

    <form action="{{ route('client-response.update', ['bdm_lead_id' => $bdm_lead_id, 'response_id' => $clientResponse->id]) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label for="response_type" class="form-label">Response Type</label>
            <select name="response_type" id="response_type" class="form-control">
                @foreach($responseTypes as $type)
                    <option value="{{ $type }}" {{ $clientResponse->response_type == $type ? 'selected' : '' }}>{{ ucfirst($type) }}</option>
                @endforeach
            </select>
        </div>
        <div class="mb-3">
            <label for="response_description" class="form-label">Description</label>
            <textarea name="response_description" id="response_description" class="form-control" rows="5">{{ $clientResponse->response_description }}</textarea>
            @error('response_description')
            <div class="text-danger">{{ $message }}</div>
        @enderror
        </div>
        <button type="submit" class="btn btn-primary">Update</button>
        <a href="{{ route('client-response.index', ['bdm_lead_id' => $bdm_lead_id]) }}" class="btn btn-secondary">Cancel</a>
    </form>
</div>
@endsection
