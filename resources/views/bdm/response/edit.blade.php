@extends('bdm.layouts.app')   
@section('content')

    <div class="container mt-5">
        <h1>Edit Client Response for Lead: {{ $clientResponse->bdmLead->client->client_name }}</h1>

        <form action="{{ route('response.update', ['bdm_lead_id' => $bdm_lead_id, 'response_id' => $clientResponse->id]) }}" method="POST">
            @csrf
            @method('PUT')
            
            <!-- Response Type Field -->
            <div class="form-group mb-3">
                <label for="response_type">Response Type</label>
                <select name="response_type" id="response_type" class="form-control">
                    @foreach ($responseTypes as $type)
                        <option value="{{ $type }}" {{ $clientResponse->response_type == $type ? 'selected' : '' }}>{{ ucfirst($type) }}</option>
                    @endforeach
                </select>
                @error('response_type')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <!-- Response Description Field -->
            <div class="form-group mb-3">
                <label for="response_description">Response Content</label>
                <textarea name="response_description" id="response_description" rows="4" class="form-control">{{ old('response_description', $clientResponse->response_description) }}</textarea>
                @error('response_description')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <!-- Hidden Client ID -->
            <input type="hidden" name="client_id" value="{{ $clientId }}">

            <button type="submit" class="btn btn-primary">Update Response</button>
        </form>
    </div>
@endsection
