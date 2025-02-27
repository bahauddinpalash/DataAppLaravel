@extends('admin.layouts.app')

@section('content')
<div class="container">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h1 class="h4 mt-2">Add New Client</h1>
    </div>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <form action="{{ route('bdm-clients.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="form-group mb-3">
            <label for="client_name">Client Name</label>
            <input type="text" name="client_name" id="client_name" class="form-control" required>
        </div>
        <div class="form-group mb-3">
            <label for="logo">Logo</label>
            <input type="file" name="logo" id="logo" class="form-control-file">
        </div>
        <div class="form-group mb-3">
            <label for="client_service_number">Client Service Number</label>
            <input type="number" name="client_service_number" id="client_service_number" class="form-control">
        </div>
        <div class="form-group mb-3">
            <label for="address">Address</label>
            <textarea name="address" id="address" class="form-control"></textarea>
        </div>
        <div class="form-group mb-3">
            <label for="remark">Remark</label>
            <textarea name="remark" id="remark" class="form-control"></textarea>
        </div>
        <div class="mb-4">
            <button type="submit" class="btn btn-primary">Submit</button>
            <a href="{{ route('bdm-clients.index') }}" class="btn btn-secondary">Cancel</a>
        </div>
    </form>
</div>
@endsection
