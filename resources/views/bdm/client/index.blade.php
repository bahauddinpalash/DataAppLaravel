@extends('bdm.layouts.app')

@section('content')
<div class="container">
    <!-- Page Title and Add Button -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h4 mt-2">Clients List</h1>
        <a href="{{ route('clients.create') }}" class="btn btn-primary mt-2">Add New Client</a>
    </div>

    <!-- Success Message -->
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <!-- Clients Table -->
    <div class="table-responsive">
        <table class="table table-bordered table-striped align-middle">
            <thead class="table-dark">
                <tr>
                    <th>ID</th>
                    <th>Client Name</th>
                    <th>Logo</th>
                    <th>Address</th>
                    <th>Service Number</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($clients as $client)
                    <tr>
                        <td>{{ $client->id }}</td>
                        <td>{{ $client->client_name }}</td>
                        <td>
                            @if($client->logo)
                                <img src="{{ asset('storage/' . $client->logo) }}" alt="Logo" width="50" class="img-thumbnail">
                            @else
                                <span class="text-muted">N/A</span>
                            @endif
                        </td>
                        <td>{{ $client->address }}</td>
                        <td>{{ $client->client_service_number }}</td>
                        <td>
                            <!-- Action Buttons -->
                           
                                <a href="{{ route('clients.show', $client->id) }}" class="btn btn-info btn-sm me-1">View</a>
                                <a href="{{ route('clients.edit', $client->id) }}" class="btn btn-warning btn-sm me-1">Edit</a>
                                {{-- <form action="{{ route('clients.destroy', $client->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this Client?');" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                                </form> --}}
                          
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="text-center text-muted">No Clients found.</td>
                    </tr>
                @endforelse
            </tbody>
            
        </table>
        {{ $clients->links() }}
    </div>
</div>
@endsection
