@extends('admin.layouts.app')

@section('content')
<div class="container">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h1 class="h4 mt-2">Clients List</h1>
        @can('client-create')
            <a href="{{ route('bdm-clients.create') }}" class="btn btn-primary mt-2">Add New Client</a>
        @endcan
    </div>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <div class="table-responsive">
        <table class="table table-bordered table-striped">
            <thead class="table-dark">
                <tr>
                    <th>ID</th>
                    <th>Client Name</th>
                    <th>Logo</th>
                    <th>Address</th>
                    <th>Service Number</th>
                    {{-- <th>Remarks</th> --}}
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
                                <img src="{{ asset('storage/' . $client->logo) }}" alt="Logo" width="50">
                            @else
                                N/A
                            @endif
                        </td>
                        <td>{{ $client->address }}</td>
                        <td>{{ $client->client_service_number }}</td>
                        {{-- <td>{{ $client->remarks }}</td> --}}
                        <td>
                            @can('client-list')
                                <a href="{{ route('bdm-clients.show', $client->id) }}" class="btn btn-sm btn-info">View</a>
                            @endcan
                            @can('client-edit')
                                <a href="{{ route('bdm-clients.edit', $client->id) }}" class="btn btn-sm btn-warning">Edit</a>
                            @endcan
                            @can('client-delete')
                                <form action="{{ route('bdm-clients.destroy', $client->id) }}" method="POST" style="display: inline-block;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure you want to delete this Client?');">Delete</button>
                                </form>
                            @endcan
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" class="text-center">No Clients found.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
        {{ $clients->links() }}
    </div>
</div>
@endsection
