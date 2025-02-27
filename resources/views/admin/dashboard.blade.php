@extends('admin.layouts.app')

@section('content')
<div class="container">
    <h2 class="pt-2 mb-4">Admin Dashboard</h2>

    {{-- Clients Section --}}
    <div class="row mb-5">
        <div class="col-md-12">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <h4>Clients</h4>
                <a href="{{ route('bdm-clients.create') }}" class="btn btn-primary">Add New Client</a>
            </div>
            
            <div class="table-responsive">
                <table class="table table-bordered table-striped">
                    <thead class="table-dark">
                        <tr>
                            <th>Client Name</th>
                            <th>Logo</th>
                            <th>Address</th>
                            <th>Service Number</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($clients as $client)
                            <tr>
                                <td>{{ $client->client_name }}</td>
                                <td>
                                    @if ($client->logo)
                                        <img src="{{ asset('storage/' . $client->logo) }}" alt="Logo" width="50" class="img-thumbnail">
                                    @else
                                        No Logo
                                    @endif
                                </td>
                                <td>{{ $client->address }}</td>
                                <td>{{ $client->client_service_number }}</td>
                                <td>
                                    
                                        <a href="{{ route('bdm-clients.show', $client->id) }}" class="btn btn-info btn-sm me-2 mb-1">View</a>
                                        <a href="{{ route('bdm-clients.edit', $client->id) }}" class="btn btn-warning btn-sm me-2 mb-1">Edit</a>
                                        <form action="{{ route('bdm-clients.destroy', $client->id) }}" method="POST" style="display:inline-block;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm mb-1" onclick="return confirm('Are you sure you want to delete this client?')">Delete</button>
                                        </form>
                               
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    {{-- Candidates Section --}}
<div class="row mb-5">
    <div class="col-md-12">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h4>Candidates</h4>
            <a href="{{ route('admin-candidates.create') }}" class="btn btn-primary">Add New Candidate</a>
        </div>
        
        <div class="table-responsive">
            <table class="table table-bordered table-striped">
                <thead class="table-dark">
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Contact Number</th>
                        <th>Position</th>
                        <th>Nationality</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($candidates as $candidate)
                        <tr>
                            <td>{{ $candidate->id }}</td>
                            <td>{{ Str::limit($candidate->name, 12) }}</td>
                            <td>{{ Str::limit($candidate->email, 12) }}</td>
                            <td>{{ $candidate->contact_number }}</td>
                            <td>{{ Str::limit($candidate->position, 12) }}</td>
                            <td>{{ $candidate->nationality }}</td>
                            <td>
                                <a href="{{ route('admin-candidates.show', $candidate->id) }}" class="btn btn-info btn-sm me-2 mb-1">View</a>
                                <a href="{{ route('admin-candidates.edit', $candidate->id) }}" class="btn btn-warning btn-sm me-2 mb-1">Edit</a>
                                <form action="{{ route('admin-candidates.destroy', $candidate->id) }}" method="POST" style="display:inline-block;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm mb-1" onclick="return confirm('Are you sure you want to delete this candidate?')">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

</div>
@endsection
