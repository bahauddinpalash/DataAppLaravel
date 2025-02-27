@extends('admin.layouts.app')

@section('content')
<div class="container pb-2">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h4 pt-3">Add New Candidate</h1>
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
            <form action="{{ route('admin-candidates.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <!-- Personal Information -->
                <h5>Personal Information</h5>
                <div class="row mb-3">
                    <div class="col-md-4">
                        <label for="name" class="form-label">Full Name</label>
                        <input type="text" name="name" id="name" class="form-control" placeholder="Enter full name" value="{{ old('name') }}" required>
                    </div>
                    <div class="col-md-4">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" name="email" id="email" class="form-control" placeholder="Enter email" value="{{ old('email') }}" required>
                    </div>
                    <div class="col-md-4">
                        <label for="contact_number" class="form-label">Contact Number</label>
                        <input type="text" name="contact_number" id="contact_number" class="form-control" placeholder="Enter contact number" value="{{ old('contact_number') }}" required>
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-md-4">
                        <label for="age" class="form-label">Age</label>
                        <input type="number" name="age" id="age" class="form-control" placeholder="Enter age" value="{{ old('age') }}" required>
                    </div>
                    <div class="col-md-4">
                        <label for="nationality" class="form-label">Nationality</label>
                        <input type="text" name="nationality" id="nationality" class="form-control" placeholder="Enter nationality" value="{{ old('nationality') }}" required>
                    </div>
                    <div class="col-md-4">
                        <label for="marital_status" class="form-label">Marital Status</label>
                        <select name="marital_status" id="marital_status" class="form-control" required>
                            <option value="">Select marital status</option>
                            <option value="Single" {{ old('marital_status') == 'Single' ? 'selected' : '' }}>Single</option>
                            <option value="Married" {{ old('marital_status') == 'Married' ? 'selected' : '' }}>Married</option>
                        </select>
                    </div>
                </div>

                <!-- Professional Details -->
                <h5>Professional Details</h5>
                <div class="row mb-3">
                    <div class="col-md-4">
                        <label for="total_experience" class="form-label">Total Experience (Years)</label>
                        <input type="number" name="total_experience" id="total_experience" class="form-control" placeholder="Enter total experience" value="{{ old('total_experience') }}" required>
                    </div>
                    <div class="col-md-4">
                        <label for="relevant_experience" class="form-label">Relevant Experience (Years)</label>
                        <input type="number" name="relevant_experience" id="relevant_experience" class="form-control" placeholder="Enter relevant experience" value="{{ old('relevant_experience') }}" required>
                    </div>
                    <div class="col-md-4">
                        <label for="current_salary" class="form-label">Current Salary</label>
                        <input type="number" step="0.01" name="current_salary" id="current_salary" class="form-control" placeholder="Enter current salary" value="{{ old('current_salary') }}" required>
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-md-4">
                        <label for="expected_salary" class="form-label">Expected Salary</label>
                        <input type="number" step="0.01" name="expected_salary" id="expected_salary" class="form-control" placeholder="Enter expected salary" value="{{ old('expected_salary') }}" required>
                    </div>
                    <div class="col-md-4">
                        <label for="highest_qualification" class="form-label">Highest Qualification</label>
                        <input type="text" name="highest_qualification" id="highest_qualification" class="form-control" placeholder="Enter highest qualification" value="{{ old('highest_qualification') }}" required>
                    </div>
                    <div class="col-md-4">
                        <label for="notice_period" class="form-label">Notice Period</label>
                        <input type="text" name="notice_period" id="notice_period" class="form-control" placeholder="Enter notice period" value="{{ old('notice_period') }}" required>
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-md-4">
                        <label for="position" class="form-label">Position</label>
                        <input type="text" name="position" id="position" class="form-control" placeholder="Enter position" value="{{ old('position') }}" required>
                    </div>
                    <div class="col-md-4">
                        <label for="interview_availability" class="form-label">Interview Availability</label>
                        <input type="text" name="interview_availability" id="interview_availability" class="form-control" placeholder="Enter interview availability" value="{{ old('interview_availability') }}" required>
                    </div>
                </div>

                <!-- Visa and Location Information -->
                <h5>Visa and Location Information</h5>
                <div class="row mb-3">
                    <div class="col-md-4">
                        <label for="visa_type" class="form-label">Visa Type</label>
                        <input type="text" name="visa_type" id="visa_type" class="form-control" placeholder="Enter visa type" value="{{ old('visa_type') }}" required>
                    </div>
                    <div class="col-md-4">
                        <label for="visa_expiry_date" class="form-label">Visa Expiry Date</label>
                        <input type="date" name="visa_expiry_date" id="visa_expiry_date" class="form-control" value="{{ old('visa_expiry_date') }}" required>
                    </div>
                    <div class="col-md-4">
                        <label for="current_location" class="form-label">Current Location</label>
                        <input type="text" name="current_location" id="current_location" class="form-control" placeholder="Enter current location" value="{{ old('current_location') }}" required>
                    </div>
                </div>

                <!-- Additional Details -->
                <h5>Additional Details</h5>
                <div class="row mb-3">
                    <div class="col-md-6">
                        <label for="job_change_reason" class="form-label">Reason for Job Change</label>
                        <textarea name="job_change_reason" id="job_change_reason" rows="3" class="form-control" placeholder="Enter reason">{{ old('job_change_reason') }}</textarea>
                    </div>
                    <div class="col-md-6">
                        <label for="cv" class="form-label">Upload CV</label>
                        <input type="file" name="cv" id="cv" class="form-control-file">
                    </div>
                </div>

                <div class="mb-4 text-end">
                    <button type="submit" class="btn btn-primary">Submit</button>
                    <a href="{{ route('admin-candidates.index') }}" class="btn btn-secondary">Cancel</a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
