@extends('admin.layouts.app')

@section('content')
<div class="container pb-2">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h4 pt-3">Edit Candidate</h1>
    </div>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    @if($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="card shadow-sm">
        <div class="card-body">
            <form action="{{ route('admin-candidates.update', $candidate->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <!-- Personal Information -->
                <h5>Personal Information</h5>
                <div class="row mb-3">
                    <div class="col-md-4">
                        <label for="name" class="form-label">Full Name</label>
                        <input type="text" name="name" id="name" class="form-control" value="{{ old('name', $candidate->name) }}" required>
                    </div>
                    <div class="col-md-4">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" name="email" id="email" class="form-control" value="{{ old('email', $candidate->email) }}" required>
                    </div>
                    <div class="col-md-4">
                        <label for="contact_number" class="form-label">Contact Number</label>
                        <input type="text" name="contact_number" id="contact_number" class="form-control" value="{{ old('contact_number', $candidate->contact_number) }}" required>
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-md-4">
                        <label for="age" class="form-label">Age</label>
                        <input type="number" name="age" id="age" class="form-control" value="{{ old('age', $candidate->age) }}" required>
                    </div>
                    <div class="col-md-4">
                        <label for="nationality" class="form-label">Nationality</label>
                        <input type="text" name="nationality" id="nationality" class="form-control" value="{{ old('nationality', $candidate->nationality) }}" required>
                    </div>
                    <div class="col-md-4">
                        <label for="marital_status" class="form-label">Marital Status</label>
                        <select name="marital_status" id="marital_status" class="form-control" required>
                            <option value="">Select marital status</option>
                            <option value="Single" {{ old('marital_status', $candidate->marital_status) == 'Single' ? 'selected' : '' }}>Single</option>
                            <option value="Married" {{ old('marital_status', $candidate->marital_status) == 'Married' ? 'selected' : '' }}>Married</option>
                        </select>
                    </div>
                </div>

                <!-- Professional Details -->
                <h5>Professional Details</h5>
                <div class="row mb-3">
                    <div class="col-md-4">
                        <label for="total_experience" class="form-label">Total Experience (Years)</label>
                        <input type="number" name="total_experience" id="total_experience" class="form-control" value="{{ old('total_experience', $candidate->total_experience) }}" required>
                    </div>
                    <div class="col-md-4">
                        <label for="relevant_experience" class="form-label">Relevant Experience (Years)</label>
                        <input type="number" name="relevant_experience" id="relevant_experience" class="form-control" value="{{ old('relevant_experience', $candidate->relevant_experience) }}" required>
                    </div>
                    <div class="col-md-4">
                        <label for="current_salary" class="form-label">Current Salary</label>
                        <input type="number" step="0.01" name="current_salary" id="current_salary" class="form-control" value="{{ old('current_salary', $candidate->current_salary) }}" required>
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-md-4">
                        <label for="expected_salary" class="form-label">Expected Salary</label>
                        <input type="number" step="0.01" name="expected_salary" id="expected_salary" class="form-control" value="{{ old('expected_salary', $candidate->expected_salary) }}" required>
                    </div>
                    <div class="col-md-4">
                        <label for="highest_qualification" class="form-label">Highest Qualification</label>
                        <input type="text" name="highest_qualification" id="highest_qualification" class="form-control" value="{{ old('highest_qualification', $candidate->highest_qualification) }}" required>
                    </div>
                    <div class="col-md-4">
                        <label for="notice_period" class="form-label">Notice Period</label>
                        <input type="text" name="notice_period" id="notice_period" class="form-control" value="{{ old('notice_period', $candidate->notice_period) }}" required>
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-md-4">
                        <label for="position" class="form-label">Position</label>
                        <input type="text" name="position" id="position" class="form-control" value="{{ old('position', $candidate->position) }}" required>
                    </div>
                    <div class="col-md-4">
                        <label for="interview_availability" class="form-label">Interview Availability</label>
                        <input type="text" name="interview_availability" id="interview_availability" class="form-control" value="{{ old('interview_availability', $candidate->interview_availability) }}" required>
                    </div>
                </div>

                <!-- Visa and Location Information -->
                <h5>Visa and Location Information</h5>
                <div class="row mb-3">
                    <div class="col-md-4">
                        <label for="visa_type" class="form-label">Visa Type</label>
                        <input type="text" name="visa_type" id="visa_type" class="form-control" value="{{ old('visa_type', $candidate->visa_type) }}" required>
                    </div>
                    <div class="col-md-4">
                        <label for="visa_expiry_date" class="form-label">Visa Expiry Date</label>
                        <input type="date" name="visa_expiry_date" id="visa_expiry_date" class="form-control" value="{{ old('visa_expiry_date', $candidate->visa_expiry_date) }}" required>
                    </div>
                    <div class="col-md-4">
                        <label for="current_location" class="form-label">Current Location</label>
                        <input type="text" name="current_location" id="current_location" class="form-control" value="{{ old('current_location', $candidate->current_location) }}" required>
                    </div>
                </div>

                <!-- Additional Details -->
                <h5>Additional Details</h5>
                <div class="row mb-3">
                    <div class="col-md-6">
                        <label for="job_change_reason" class="form-label">Reason for Job Change</label>
                        <textarea name="job_change_reason" id="job_change_reason" rows="3" class="form-control">{{ old('job_change_reason', $candidate->job_change_reason) }}</textarea>
                    </div>
                    <div class="col-md-6">
                        <label for="cv" class="form-label">Upload CV</label>
                        <input type="file" name="cv" id="cv" class="form-control-file">
                        <small class="form-text text-muted">Leave blank to keep the existing CV.</small>
                    </div>
                </div>

                <div class="mb-4 text-end">
                    <button type="submit" class="btn btn-primary">Update</button>
                    <a href="{{ route('admin-candidates.index') }}" class="btn btn-secondary">Cancel</a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
