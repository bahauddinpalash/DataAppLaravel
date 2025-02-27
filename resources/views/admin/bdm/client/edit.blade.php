@extends('admin.layouts.app')

@section('content')
<div class="container">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h1 class="h4 mt-2">Edit Client</h1>
    </div>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <form action="{{ route('bdm-clients.update', $client->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="form-group mb-3">
            <label for="client_name">Client Name</label>
            <input type="text" name="client_name" id="client_name" class="form-control" value="{{ old('client_name', $client->client_name) }}" required>
            @error('client_name')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
        <div class="form-group mb-3">
            <label for="logo">Logo</label>
            <input type="file" name="logo" id="logo" class="form-control-file">
            @if($client->logo)
                <div class="mt-2">
                    <img src="{{ asset('storage/' . $client->logo) }}" alt="Logo" width="100">
                </div>
            @endif
            @error('logo')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
        <div class="form-group mb-3">
            <label for="client_service_number">Client Service Number</label>
            <input type="number" name="client_service_number" id="client_service_number" class="form-control" value="{{ old('client_service_number', $client->client_service_number) }}">
            @error('client_service_number')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
        <div class="form-group mb-3">
            <label for="address">Address</label>
            <textarea name="address" id="address" class="form-control">{{ old('address', $client->address) }}</textarea>
            @error('address')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
        <div class="form-group mb-3">
            <label for="remarks">Remarks</label>
            <textarea name="remarks" id="remarks" class="form-control">{{ old('remarks', $client->remarks) }}</textarea>
            @error('remarks')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-4">
            <button type="submit" class="btn btn-primary">Update</button>
            <a href="{{ route('bdm-clients.index') }}" class="btn btn-secondary">Cancel</a>
        </div>
    </form>
</div>
@endsection
