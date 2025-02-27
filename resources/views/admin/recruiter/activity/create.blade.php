@extends('admin.layouts.app')

@section('content')
<div class="container">
    <h4 class="pt-2">Add New Recruit Activity for Lead #{{ $lead->id }}</h4>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('admin_recruit_activities.store', $lead->id) }}" method="POST">
        @csrf

        <!-- Activity Type -->
        <div class="form-group mb-3">
            <label for="activity_type">Activity Type</label>
            <select name="activity_type" id="activity_type" class="form-control" required>
                <option value="" disabled selected>Select Activity Type</option>
                @foreach ($activityTypes as $type)
                    <option value="{{ $type }}" {{ old('activity_type') == $type ? 'selected' : '' }}>
                        {{ ucfirst($type) }}
                    </option>
                @endforeach
            </select>
        </div>

        <!-- Activity Description -->
        <div class="form-group mb-3">
            <label for="activity_description">Description</label>
            <textarea 
                name="activity_description" 
                id="activity_description" 
                class="form-control" 
                rows="4"
                required
            >{{ old('activity_description') }}</textarea>
        </div>

        <!-- Action Buttons -->
        <div class="d-flex">
            <button type="submit" class="btn btn-primary mr-2">Save Activity</button>
            <a href="{{ route('admin_recruit_activities.index', $lead->id) }}" class="btn btn-secondary">Cancel</a>
        </div>
    </form>
</div>
@endsection
