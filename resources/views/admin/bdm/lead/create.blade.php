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

    <form action="{{ route('admin-bdm-leads.store') }}" method="POST">
        @csrf
        <div class="form-group mb-3">
            <label for="client_id">Client Name</label>
            <select name="client_id" id="client_id" class="form-control" required>
                @foreach ($clients as $client)
                    <option value="{{ $client->id }}">{{ $client->client_name }}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group mb-3">
            <label for="lead_status">Data Status</label>
            <input type="text" name="lead_status" id="lead_status" class="form-control" value="{{ old('lead_status') }}" required>
        </div>
        <div class="form-group mb-3">
            <label for="client_meeting">Client Meeting</label>
            <input type="datetime-local" name="client_meeting" id="client_meeting" class="form-control" value="{{ old('client_meeting') }}">
        </div>
        <div class="form-group mb-3">
            <label for="remark">Remark</label>
            <textarea name="remark" id="remark" class="form-control">{{ old('remark') }}</textarea>
        </div>
        <div class="d-flex">
            <button type="submit" class="btn btn-primary mr-2">Submit</button>
            <a href="{{ route('admin-bdm-leads.index') }}" class="btn btn-secondary">Cancel</a>
        </div>
    </form>
</div>
@endsection
