@extends('bdm.layouts.app')

@section('content')
<div class="container">
    <h2 class="pt-2 mb-4">BDM Dashboard</h2>
    <div class="row">
        <div class="col-md-10 mb-4">
            <h2>Clients</h2>
            <div class="table-responsive">
                <table class="table table-bordered table-striped">
                    <thead class="thead-dark">
                        <tr>
                            <th>ID</th>
                            <th>Client Name</th>
                            <th>Logo</th>
                            {{-- <th>Address</th> --}}
                            <th>Service Number</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($clients as $client)
                            <tr>
                                <td>{{ $client->id }}</td>
                                <td>{{ $client->client_name }}</td>
                                <td>
                                    @if ($client->logo)
                                        <img src="{{ asset('storage/' . $client->logo) }}" alt="Logo" width="50" class="img-thumbnail">
                                    @endif
                                </td>
                                {{-- <td>{{ $client->address }}</td> --}}
                                <td>{{ $client->client_service_number }}</td>
                                <td>
                                    <div class="btn-group" role="group">
                                        <a href="{{ route('clients.show', $client->id) }}" class="btn btn-info btn-sm mb-1 mr-1">View</a>
                                        <a href="{{ route('clients.edit', $client->id) }}" class="btn btn-warning btn-sm mb-1 mr-1">Edit</a>
                                        <form action="{{ route('clients.destroy', $client->id) }}" method="POST" style="display:inline-block;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm mb-1" onclick="return confirm('Are you sure you want to delete this Client?')">Delete</button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        <div class="col-md-10 mb-4">
            <h2>Datas</h2>
            <div class="table-responsive">
                <table class="table table-bordered table-striped">
                    <thead class="thead-dark">
                        <tr>
                            <th>ID</th>
                            
                            <th>Client Name</th>
                            <th>Status</th>
                            <th>Client Meeting</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($leads as $lead)
                            <tr>
                                <td>{{ $lead->id }}</td>
                                
                                <td>{{ $lead->client->client_name }}</td>
                                <td>{{ ucfirst($lead->lead_status) }}</td>
                                <td>{{ $lead->client_meeting ? \Carbon\Carbon::parse($lead->client_meeting)->format('Y-m-d H:i') : 'Not Scheduled' }}</td>
                                <td>
                                    <div class="btn-group" role="group">
                                        <a href="{{ route('bdm-leads.show', $lead->id) }}" class="btn btn-info btn-sm mb-1 mr-1">View</a>
                                        <a href="{{ route('bdm-leads.edit', $lead->id) }}" class="btn btn-warning btn-sm mb-1 mr-1">Edit</a>
                                        <form action="{{ route('bdm-leads.destroy', $lead->id) }}" method="POST" style="display:inline-block;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm mb-1" onclick="return confirm('Are you sure you want to delete this Lead?')">Delete</button>
                                        </form>
                                    </div>
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
