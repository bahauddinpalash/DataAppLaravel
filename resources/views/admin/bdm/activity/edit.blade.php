@extends('admin.layouts.app')   

@section('content')
<div class="container">
    <h4 class="pt-2">Edit BDM Activity for Lead: {{ $salesActivity->lead->client->client_name }}</h4>
    
    <form action="{{ route('bdm-activities.update', ['bdm_lead_id' => $salesActivity->bdm_lead_id, 'bdm_activity' => $salesActivity->id]) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="form-group mb-3">
            <label for="activity_type">Activity Type</label>
            <select name="activity_type" id="activity_type" class="form-control">
                <option value="">Select Activity Type</option>
                @foreach ($activityTypes as $type)
                    <option value="{{ $type }}" {{ $salesActivity->activity_type == $type ? 'selected' : '' }}>
                        {{ ucfirst($type) }}
                    </option>
                @endforeach
            </select>
            @error('activity_type')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group mb-3">
            <label for="activity_description">Activity Description</label>
            <textarea name="activity_description" id="activity_description" rows="4" class="form-control">{{ old('activity_description', $salesActivity->activity_description) }}</textarea>
            @error('activity_description')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <button type="submit" class="btn btn-primary">Update Activity</button>
        <a href="{{ route('bdm-activities.index', $salesActivity->bdm_lead_id) }}" class="btn btn-secondary">Cancel</a>
    </form>
</div>
@endsection
