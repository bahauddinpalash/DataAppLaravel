@extends('recruiter.layouts.app')

@section('content')
<div class="container">
    <h1>Edit Recruit Activity for Lead: {{ $recruitActivity->recruit_lead_id }}</h1>
    
    <form action="{{ route('recruit_activities.update', ['recruit_lead_id' => $recruitActivity->recruit_lead_id, 'id' => $recruitActivity->id]) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label for="activity_type">Activity Type</label>
            <select name="activity_type" id="activity_type" class="form-control">
                @foreach($activityTypes as $type)
                    <option value="{{ $type }}" {{ $recruitActivity->activity_type == $type ? 'selected' : '' }}>{{ ucfirst($type) }}</option>
                @endforeach
            </select>
            @error('activity_type')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
        
        <div class="form-group mt-3">
            <label for="activity_description">Description</label>
            <textarea name="activity_description" id="activity_description" class="form-control" rows="4">{{ old('activity_description', $recruitActivity->activity_description) }}</textarea>
            @error('activity_description')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="mt-3">
            <button type="submit" class="btn btn-success">Update Activity</button>
            <a href="{{ route('recruit_activities.index', $recruitActivity->recruit_lead_id) }}" class="btn btn-secondary">Cancel</a>
        </div>
    </form>
</div>
@endsection
