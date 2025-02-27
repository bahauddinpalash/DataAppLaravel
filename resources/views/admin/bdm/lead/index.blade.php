@extends('admin.layouts.app')

@section('content')
<div class="container">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h4 class="h4 mt-2">Datas List</h4>
        <a href="{{ route('admin-bdm-leads.create') }}" class="btn btn-primary mt-2">Add New Data</a>
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
                    <th>Data Status</th>
                    <th>Client Meeting</th>
                    <th>BDM Activities</th>
                    <th>Client Response</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($leads as $lead)
                    <tr>
                        <td>{{ $lead->id }}</td>
                        <td>{{ $lead->client->client_name }}</td>
                        <td>{{ ucfirst($lead->lead_status) }}</td>
                        <td>{{ $lead->client_meeting ? \Carbon\Carbon::parse($lead->client_meeting)->format('Y-m-d H:i') : 'Not Scheduled' }}</td>
                        <td class="text-center">
                            <div class="btn-group-vertical" role="group">
                                <a href="{{ route('bdm-activities.index', ['bdm_lead_id' => $lead->id]) }}" class="btn btn-sm btn-info mb-1">View</a>
                                <a href="{{ route('bdm-activities.create', ['bdm_lead_id' => $lead->id]) }}" class="btn btn-sm btn-success">+</a>
                            </div>
                        </td>
                        <td class="text-center">
                            <div class="btn-group-vertical" role="group">
                                <a href="{{ route('client-response.index', ['bdm_lead_id' => $lead->id]) }}" class="btn btn-sm btn-info mb-1">View</a>
                                <a href="{{ route('client-response.create', ['bdm_lead_id' => $lead->id]) }}" class="btn btn-sm btn-success">+</a>
                            </div>
                        </td>
                        <td>
                            <div class="btn-group" role="group">
                                <a href="{{ route('admin-bdm-leads.show', $lead->id) }}" class="btn btn-info btn-sm" style="margin-right: 0.5rem;"><i class="fas fa-eye"></i></a>
                                <a href="{{ route('admin-bdm-leads.edit', $lead->id) }}" class="btn btn-warning btn-sm" style="margin-right: 0.5rem;"><i class="fas fa-edit"></i></a>
                                <form action="{{ route('admin-bdm-leads.destroy', $lead->id) }}" method="POST" style="display:inline-block;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this lead?');"><i class="fas fa-trash-alt"></i></button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" class="text-center">No Data found.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
