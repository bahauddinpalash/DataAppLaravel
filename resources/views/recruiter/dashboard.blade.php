<!-- resources/views/admin/dashboard.blade.php -->
@extends('recruiter.layouts.app')

@section('content')
<div class="container">
    <h2 class="pt-2 mb-4">Recruiter Dashboard</h2>
    <div class="row">
        <div class="col-md-12 mb-4">
            <h2>Candidates</h2>
            <div class="table-responsive">
                <table class="table table-bordered table-striped">
                    <thead class="thead-dark">
                        <tr>
                            <th>Id</th>
                            <th>Candidate Name</th>
                            <th>Address</th>
                            <th>Service Number</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($candidates as $candidate)
                            <tr>
                                <td>{{ $candidate->id }}</td>
                                <td>{{ $candidate->name }}</td>
                                <td>{{ $candidate->nationality }}</td>
                                <td>{{ $candidate->contact_number }}</td>
                                <td>
                                    <div class="btn-group" role="group">
                                        <a href="{{ route('candidates.show', $candidate->id) }}" class="btn btn-info btn-sm mb-1 mr-1">View</a>
                                        <a href="{{ route('candidates.edit', $candidate->id) }}" class="btn btn-warning btn-sm mb-1 mr-1">Edit</a>
                                        {{-- <form action="{{ route('candidates.destroy', $candidate->id) }}" method="POST" style="display:inline-block;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm mb-1" onclick="return confirm('Are you sure you want to delete this Candidate?')">Delete</button>
                                        </form> --}}
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        <div class="col-md-12 mb-4">
            <h2>Datas</h2>
            <div class="table-responsive">
                <table class="table table-bordered table-striped">
                    <thead class="thead-dark">
                        <tr>
                            <th>Id</th>
                            <th>Candidate Name</th>
                            <th>Data Status</th>
                            <th>Candidate Meeting</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($leads as $lead)
                            <tr>
                                <td>{{ $lead->id }}</td>
                                <td>{{ $lead->candidate->name }}</td>
                                <td>{{ ucfirst($lead->lead_status) }}</td>
                                <td>{{ $lead->candidate_meeting ? \Carbon\Carbon::parse($lead->client_meeting)->format('Y-m-d H:i') : 'Not Scheduled' }}</td>
                                <td>
                                    <div class="btn-group" role="group">
                                        <a href="{{ route('leads.show', $lead->id) }}" class="btn btn-info btn-sm mb-1 mr-1">View</a>
                                        <a href="{{ route('leads.edit', $lead->id) }}" class="btn btn-warning btn-sm mb-1 mr-1">Edit</a>
                                        {{-- <form action="{{ route('leads.destroy', $lead->id) }}" method="POST" style="display:inline-block;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm mb-1" onclick="return confirm('Are you sure you want to delete this Lead?')">Delete</button>
                                        </form> --}}
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
