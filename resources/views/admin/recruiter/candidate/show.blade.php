@extends('admin.layouts.app')

@section('content')
<div class="container pb-2">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h4 pt-3">Candidate Details</h1>
        <a href="{{ route('admin-candidates.index') }}" class="btn btn-secondary">Back to List</a>
    </div>

    <div class="card shadow-sm">
        <div class="card-body">
            <!-- Personal Information -->
            <h5>Personal Information</h5>
            <div class="row mb-3">
                <div class="col-md-4">
                    <strong>Full Name:</strong>
                    <p>{{ $candidate->name }}</p>
                </div>
                <div class="col-md-4">
                    <strong>Email:</strong>
                    <p>{{ $candidate->email }}</p>
                </div>
                <div class="col-md-4">
                    <strong>Contact Number:</strong>
                    <p>{{ $candidate->contact_number }}</p>
                </div>
            </div>
            <div class="row mb-3">
                <div class="col-md-4">
                    <strong>Age:</strong>
                    <p>{{ $candidate->age }}</p>
                </div>
                <div class="col-md-4">
                    <strong>Nationality:</strong>
                    <p>{{ $candidate->nationality }}</p>
                </div>
                <div class="col-md-4">
                    <strong>Marital Status:</strong>
                    <p>{{ $candidate->marital_status }}</p>
                </div>
            </div>

            <!-- Professional Details -->
            <h5>Professional Details</h5>
            <div class="row mb-3">
                <div class="col-md-4">
                    <strong>Total Experience (Years):</strong>
                    <p>{{ $candidate->total_experience }}</p>
                </div>
                <div class="col-md-4">
                    <strong>Relevant Experience (Years):</strong>
                    <p>{{ $candidate->relevant_experience }}</p>
                </div>
                <div class="col-md-4">
                    <strong>Current Salary:</strong>
                    <p>${{ $candidate->current_salary }}</p>
                </div>
            </div>
            <div class="row mb-3">
                <div class="col-md-4">
                    <strong>Expected Salary:</strong>
                    <p>${{ $candidate->expected_salary }}</p>
                </div>
                <div class="col-md-4">
                    <strong>Highest Qualification:</strong>
                    <p>{{ $candidate->highest_qualification }}</p>
                </div>
                <div class="col-md-4">
                    <strong>Notice Period:</strong>
                    <p>{{ $candidate->notice_period }}</p>
                </div>
            </div>
            <div class="row mb-3">
                <div class="col-md-4">
                    <strong>Position:</strong>
                    <p>{{ $candidate->position }}</p>
                </div>
                <div class="col-md-4">
                    <strong>Interview Availability:</strong>
                    <p>{{ $candidate->interview_availability }}</p>
                </div>
            </div>

            <!-- Visa and Location Information -->
            <h5>Visa and Location Information</h5>
            <div class="row mb-3">
                <div class="col-md-4">
                    <strong>Visa Type:</strong>
                    <p>{{ $candidate->visa_type }}</p>
                </div>
                <div class="col-md-4">
                    <strong>Visa Expiry Date:</strong>
                    <p>{{ $candidate->visa_expiry_date }}</p>
                </div>
                <div class="col-md-4">
                    <strong>Current Location:</strong>
                    <p>{{ $candidate->current_location }}</p>
                </div>
            </div>

            <!-- Additional Details -->
            <h5>Additional Details</h5>
            <div class="row mb-3">
                <div class="col-md-6">
                    <strong>Reason for Job Change:</strong>
                    <p>{{ $candidate->job_change_reason }}</p>
                </div>
                <div class="col-md-6">
                    <strong>Uploaded CV:</strong>
                    @if($candidate->cv)
                        <p><a href="{{ asset('storage/' . $candidate->cv) }}" target="_blank">Download CV</a></p>
                    @else
                        <p>No CV uploaded</p>
                    @endif
                </div>
            </div>
                <!-- Created By & Updated By -->
                <h5>Record Information</h5>
                <div class="row mb-3">
                    <div class="col-md-6">
                        <strong>Created By:</strong>
                        <p>{{ $candidate->created_by ?? 'N/A' }} on {{ $candidate->created_at->format('d M Y, h:i A') }}</p>
                    </div>
                    <div class="col-md-6">
                        <strong>Updated By:</strong>
                        @if($candidate->updated_by)
                            <p>{{ $candidate->updated_by }} on {{ $candidate->updated_at->format('d M Y, h:i A') }}</p>
                        @else
                            <p>N/A</p>
                        @endif
                    </div>
                </div>
            <div class="mb-4 text-end">
                <a href="{{ route('admin-candidates.edit', $candidate->id) }}" class="btn btn-primary">Edit</a>
                <form action="{{ route('admin-candidates.destroy', $candidate->id) }}" method="POST" class="d-inline">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this candidate?')">Delete</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
