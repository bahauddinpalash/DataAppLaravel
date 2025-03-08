@extends('bdm.layouts.app')

@section('content')

<div class="container">
    <h4 class="pt-2">Create Data</h4>
    
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('bdm-leads.store') }}" method="POST">
        @csrf

        <div class="form-group mb-3">
            <label for="client_id">Client</label>
            <select name="client_id" id="client_id" class="form-control" required>
                <option value="">Select Client</option>
                @foreach($clients as $client)
                    <option value="{{ $client->id }}">{{ $client->client_name }}</option>
                @endforeach
            </select>
        </div>

        <div class="form-group mb-3">
            <label for="lead_status">Status</label>
            <input 
                type="text" 
                class="form-control" 
                name="lead_status" 
                id="lead_status" 
                value="{{ old('lead_status') }}" 
                required
            >
        </div>

        <div class="form-group mb-3">
            <label for="client_meeting">Client Meeting</label>
            <input 
                type="datetime-local" 
                class="form-control" 
                name="client_meeting" 
                id="client_meeting" 
                value="{{ old('client_meeting') }}"
            >
        </div>

        <div class="form-group mb-3">
            <label for="remark">Remark</label>
            <textarea 
                class="form-control" 
                name="remark" 
                id="remark" 
                rows="3"
            >{{ old('remark') }}</textarea>
        </div>

        <div class="d-flex">
            <button type="submit" class="btn btn-primary mr-2">Create</button>
            <a href="{{ route('bdm-leads.index') }}" class="btn btn-secondary">Cancel</a>
        </div>
    </form>
</div>

@endsection
