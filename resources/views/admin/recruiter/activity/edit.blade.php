@extends('admin.layouts.app')

@section('content')
<div class="container">
    <h4 class="pt-2">Edit Recruit Activity for Lead #{{ $recruitActivity->recruit_lead_id }}</h4>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('admin_recruit_activities.update', ['recruit_lead_id' => $recruitActivity->recruit_lead_id, 'id' => $recruitActivity->id]) }}" method="POST">
        @csrf
        @method('PUT')

        <!-- Activity Type -->
        <div class="form-group mb-3">
            <label for="activity_type">Activity Type</label>
            <select name="activity_type" id="activity_type" class="form-control" required>
                <option value="" disabled>Select Activity Type</option>
                @foreach($activityTypes as $type)
                    <option value="{{ $type }}" {{ $recruitActivity->activity_type == $type ? 'selected' : '' }}>
                        {{ ucfirst($type) }}
                    </option>
                @endforeach
            </select>
            @error('activity_type')
                <div class="text-danger">{{ $message }}</div>
            @enderror
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
            >{{ old('activity_description', $recruitActivity->activity_description) }}</textarea>
            @error('activity_description')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <!-- Action Buttons -->
        <div class="d-flex">
            <button type="submit" class="btn btn-primary mr-2">Update Activity</button>
            <a href="{{ route('admin_recruit_activities.index', $recruitActivity->recruit_lead_id) }}" class="btn btn-secondary">Cancel</a>
        </div>
    </form>
</div>
@endsection
