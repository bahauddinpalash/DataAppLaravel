@extends('recruiter.layouts.app')

@section('content')
<div class="container pb-2">
    <div class="mb-4">
        <h1 class="h4 pt-3">Edit Candidate</h1>
    </div>

    <div class="card shadow-sm">
        <div class="card-body">
            <form action="{{ route('candidates.update', $candidate->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <!-- Personal Information -->
                <h5>Personal Information</h5>
                <div class="row mb-3">
                    <div class="col-md-4">
                        <label for="name" class="form-label">Full Name</label>
                        <input type="text" class="form-control" id="name" name="name" value="{{ old('name', $candidate->name) }}" required>
                        @error('name')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-4">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" class="form-control" id="email" name="email" value="{{ old('email', $candidate->email) }}" required>
                        @error('email')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-4">
                        <label for="contact_number" class="form-label">Contact Number</label>
                        <input type="number" class="form-control" id="contact_number" name="contact_number" value="{{ old('contact_number', $candidate->contact_number) }}" required>
                        @error('contact_number')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-md-4">
                        <label for="age" class="form-label">Age</label>
                        <input type="number" class="form-control" id="age" name="age" value="{{ old('age', $candidate->age) }}">
                        @error('age')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-4">
                        <label for="nationality" class="form-label">Nationality</label>
                        <input type="text" class="form-control" id="nationality" name="nationality" value="{{ old('nationality', $candidate->nationality) }}">
                        @error('nationality')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-4">
                        <label for="marital_status" class="form-label">Marital Status</label>
                        <select class="form-control" id="marital_status" name="marital_status">
                            <option value="Single" {{ old('marital_status', $candidate->marital_status) == 'Single' ? 'selected' : '' }}>Single</option>
                            <option value="Married" {{ old('marital_status', $candidate->marital_status) == 'Married' ? 'selected' : '' }}>Married</option>
                        </select>
                        @error('marital_status')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
              
                <!-- Professional Details -->
                <h5>Professional Details</h5>
                <div class="row mb-3">
                    <div class="col-md-4">
                        <label for="total_experience" class="form-label">Total Experience (years)</label>
                        <input type="number" class="form-control" id="total_experience" name="total_experience" value="{{ old('total_experience', $candidate->total_experience) }}">
                        @error('total_experience')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-4">
                        <label for="relevant_experience" class="form-label">Relevant Experience (years)</label>
                        <input type="number" class="form-control" id="relevant_experience" name="relevant_experience" value="{{ old('relevant_experience', $candidate->relevant_experience) }}">
                        @error('relevant_experience')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-4">
                        <label for="current_salary" class="form-label">Current Salary ($)</label>
                        <input type="number" step="0.01" class="form-control" id="current_salary" name="current_salary" value="{{ old('current_salary', $candidate->current_salary) }}">
                        @error('current_salary')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-md-4">
                        <label for="expected_salary" class="form-label">Expected Salary ($)</label>
                        <input type="number" step="0.01" class="form-control" id="expected_salary" name="expected_salary" value="{{ old('expected_salary', $candidate->expected_salary) }}">
                        @error('expected_salary')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-4">
                        <label for="highest_qualification" class="form-label">Highest Qualification</label>
                        <input type="text" class="form-control" id="highest_qualification" name="highest_qualification" value="{{ old('highest_qualification', $candidate->highest_qualification) }}">
                        @error('highest_qualification')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-4">
                        <label for="notice_period" class="form-label">Notice Period</label>
                        <input type="text" class="form-control" id="notice_period" name="notice_period" value="{{ old('notice_period', $candidate->notice_period) }}">
                        @error('notice_period')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-md-4">
                        <label for="position" class="form-label">Position</label>
                        <input type="text" class="form-control" id="position" name="position" value="{{ old('position', $candidate->position) }}">
                        @error('position')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-4">
                        <label for="interview_availability" class="form-label">Interview Availability</label>
                        <input type="text" class="form-control" id="interview_availability" name="interview_availability" value="{{ old('interview_availability', $candidate->interview_availability) }}">
                        @error('interview_availability')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <!-- Visa and Location Information -->
                <h5>Visa and Location Information</h5>
                <div class="row mb-3">
                    <div class="col-md-4">
                        <label for="visa_type" class="form-label">Visa Type</label>
                        <input type="text" class="form-control" id="visa_type" name="visa_type" value="{{ old('visa_type', $candidate->visa_type) }}">
                        @error('visa_type')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-4">
                        <label for="visa_expiry_date" class="form-label">Visa Expiry Date</label>
                        <input type="date" class="form-control" id="visa_expiry_date" name="visa_expiry_date" value="{{ old('visa_expiry_date', $candidate->visa_expiry_date) }}">
                        @error('visa_expiry_date')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-4">
                        <label for="current_location" class="form-label">Current Location</label>
                        <input type="text" class="form-control" id="current_location" name="current_location" value="{{ old('current_location', $candidate->current_location) }}">
                        @error('current_location')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <!-- Additional Details -->
                <h5>Additional Details</h5>
                <div class="mb-3">
                    <label for="job_change_reason" class="form-label">Reason for Job Change</label>
                    <textarea class="form-control" id="job_change_reason" name="job_change_reason" rows="3">{{ old('job_change_reason', $candidate->job_change_reason) }}</textarea>
                    @error('job_change_reason')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="cv" class="form-label">Upload CV</label>
                    <input type="file" class="form-control" id="cv" name="cv">
                    @if($candidate->cv)
                        <small class="text-muted">Current CV: <a href="{{ asset('storage/' . $candidate->cv) }}" target="_blank">Download CV</a></small>
                    @endif
                    @error('cv')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Buttons -->
                
                    <button type="submit" class="btn btn-primary">Update</button>
                    <a href="{{ route('candidates.index') }}" class="btn btn-secondary">Cancel</a>
               
            </form>
        </div>
    </div>
</div>
@endsection
