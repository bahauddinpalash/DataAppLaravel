@extends('bdm.layouts.app')

@section('content')
<div class="container">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h4 class="h4 mt-2">Datas List</h4>
        <a href="{{ route('bdm-leads.create') }}" class="btn btn-primary mt-2">Add New Data</a>
    </div>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif
    <div class="table-responsive">
        <table class="table table-bordered table-striped table-hover">
            <thead class="thead-dark">
                <tr>
                    <th>ID</th>
                    <th>Client Name</th>
                    <th>Status</th>
                    <th>Client Meeting</th>
                    <th>Remark</th>
                    <th>Sales Activities</th>
                    <th>Client Responses</th>
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
                        <td>{{ $lead->remark ?: 'No remarks added' }}</td>
                        
                        <!-- Sales Activities -->
                        <td class="text-center">
                            <div class="btn-group-vertical" role="group">
                                <a href="{{ route('sales_activities.index', ['bdm_lead_id' => $lead->id]) }}" class="btn btn-sm btn-info mb-1">View</a>
                                <a href="{{ route('sales_activities.create', ['bdm_lead_id' => $lead->id]) }}" class="btn btn-sm btn-success">+</a>
                            </div>
                        </td>
                        
                        <!-- Client Responses -->
                        <td class="text-center">
                            <div class="btn-group-vertical" role="group">
                                <a href="{{ route('response.index', ['bdm_lead_id' => $lead->id]) }}" class="btn btn-sm btn-info mb-1">View</a>
                                <a href="{{ route('response.create', ['bdm_lead_id' => $lead->id]) }}" class="btn btn-sm btn-success">+</a>
                            </div>
                        </td>
                        
                        <td>
                            <div class="btn-group" role="group">
                                <a href="{{ route('bdm-leads.show', $lead->id) }}" class="btn btn-info btn-sm" style="margin-right: 0.5rem;">View</a>
                                <a href="{{ route('bdm-leads.edit', $lead->id) }}" class="btn btn-warning btn-sm" style="margin-right: 0.5rem;">Edit</a>
                                <form action="{{ route('bdm-leads.destroy', $lead->id) }}" method="POST" style="display:inline-block;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this Lead?')">Delete</button>
                                </form>
                            </div>
                            
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
