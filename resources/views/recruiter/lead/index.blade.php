@extends('recruiter.layouts.app')

@section('content')
<div class="container">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h4 class="h4 mt-2">Datas List</h4>
        <a href="{{ route('leads.create') }}" class="btn btn-primary mt-2">Add New Data</a>
    </div>

    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="table-responsive">
        <table class="table table-bordered table-striped table-hover">
            <thead class="thead-dark">
                <tr>
                    <th>ID</th>
                    <th>Candidate Name</th>
                    <th>Status</th>
                    <th>Position</th>
                    <th>Meeting Date</th>
                    {{-- <th>Remark</th> --}}
                    <th class="text-center">Recruit Activity</th>
                    <th class="text-center">Candidate Response</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($leads as $lead)
                    <tr>
                        <td>{{ $lead->id }}</td>
                        <td>{{ $lead->candidate->name }}</td>
                        <td>{{ ucfirst($lead->lead_status) }}</td>
                        <td>{{ $lead->position }}</td>
                        <td>{{ $lead->candidate_meeting ? \Carbon\Carbon::parse($lead->candidate_meeting)->format('Y-m-d H:i') : 'Not Scheduled' }}</td>
                        {{-- <td>{{ $lead->remark ?: 'No remarks added' }}</td> --}}
                        
                        <!-- Recruit Activity -->
                        <td class="text-center">
                            <div class="btn-group-vertical" role="group">
                                <a href="{{ route('recruit_activities.index', ['recruit_lead_id' => $lead->id]) }}" class="btn btn-sm btn-info mb-1">View</a>
                                <a href="{{ route('recruit_activities.create', ['recruit_lead_id' => $lead->id]) }}" class="btn btn-sm btn-success">+</a>
                            </div>
                        </td>
                        
                        <!-- Candidate Response -->
                        <td class="text-center">
                            <div class="btn-group-vertical" role="group">
                                <a href="{{ route('candidate_responses.index', ['recruit_lead_id' => $lead->id]) }}" class="btn btn-sm btn-info mb-1">View</a>
                                <a href="{{ route('candidate_responses.create', ['recruit_lead_id' => $lead->id]) }}" class="btn btn-sm btn-success">+</a>
                            </div>
                        </td>
                        
                        <!-- Actions -->
                        <td>
                            <div class="btn-group" role="group">
                                <a href="{{ route('leads.show', $lead->id) }}" class="btn btn-info btn-sm" style="margin-right: 0.5rem;">View</a>
                                <a href="{{ route('leads.edit', $lead->id) }}" class="btn btn-warning btn-sm" style="margin-right: 0.5rem;">Edit</a>
                                <form action="{{ route('leads.destroy', $lead->id) }}" method="POST" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure?')">Delete</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        {{ $leads->links() }}
    </div>
</div>
@endsection
