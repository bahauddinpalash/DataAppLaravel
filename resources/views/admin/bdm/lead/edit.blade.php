@extends('admin.layouts.app')

@section('content')
<div class="container">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h1 class="h4 mt-2">Edit Data(BDM)</h1>
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

    <form action="{{ route('admin-bdm-leads.update', $lead->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="form-group mb-3">
            <label for="client_id">Client Name</label>
            <select name="client_id" id="client_id" class="form-control" required>
                @foreach ($clients as $client)
                    <option value="{{ $client->id }}" {{ $lead->client_id == $client->id ? 'selected' : '' }}>{{ $client->client_name }}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group mb-3">
            <label for="lead_status">Data Status</label>
            <input type="text" name="lead_status" id="lead_status" class="form-control" value="{{ old('lead_status', $lead->lead_status) }}" required>
        </div>
        <div class="form-group mb-3">
            <label for="client_meeting">Client Meeting</label>
            <input type="datetime-local" name="client_meeting" id="client_meeting" class="form-control" value="{{ old('client_meeting', $lead->client_meeting ? \Carbon\Carbon::parse($lead->client_meeting)->format('Y-m-d\TH:i') : '') }}">
        </div>
        <div class="form-group mb-3">
            <label for="remark">Remark</label>
            <textarea name="remark" id="remark" class="form-control">{{ old('remark', $lead->remark) }}</textarea>
        </div>
        <div class="d-flex">
            <button type="submit" class="btn btn-primary mr-2">Update</button>
            <a href="{{ route('admin-bdm-leads.index') }}" class="btn btn-secondary">Cancel</a>
        </div>
    </form>
</div>
@endsection
