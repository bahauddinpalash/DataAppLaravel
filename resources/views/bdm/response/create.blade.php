@extends('bdm.layouts.app')   
@section('content')

    <div class="container mt-5">
        <h1>Add Client Response for Lead: {{ $lead->client->client_name }}</h1>

        <form action="{{ route('response.store', ['bdm_lead_id' => $lead->id]) }}" method="POST">
            @csrf
            <div class="form-group mb-3">
                <label for="response_type">Response Type</label>
                <select name="response_type" id="response_type" class="form-control">
                    <option value="">Select Response Type</option>
                    @foreach ($responseTypes as $type)
                        <option value="{{ $type }}" {{ old('response_type') == $type ? 'selected' : '' }}>
                            {{ ucfirst($type) }}
                        </option>
                    @endforeach
                </select>
                @error('response_type')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group mb-3">
                <label for="response_description">Response Description</label>
                <textarea name="response_description" id="response_description" rows="4" class="form-control">{{ old('response_description') }}</textarea>
                @error('response_description')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            {{-- <div class="form-group mb-3">
                <label for="received_by">Received By</label>
                <input type="text" name="received_by" id="received_by" class="form-control" value="{{ old('received_by') }}">
                @error('received_by')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div> --}}

            <button type="submit" class="btn btn-primary">Save Response</button>
        </form>
    </div>
@endsection
