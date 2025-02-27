@extends('admin.layouts.app')

@section('content')
<div class="container">
    <h4 class="pt-2">Add New BDM Activity</h4>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('bdm-activities.store', $lead->id) }}" method="POST">
        @csrf
        <div class="form-group mb-3">
            <label for="activity_type">Activity Type</label>
            <select name="activity_type" id="activity_type" class="form-control" required>
                @foreach ($activityTypes as $type)
                    <option value="{{ $type }}">{{ ucfirst($type) }}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group mb-3">
            <label for="activity_description">Activity Description</label>
            <textarea name="activity_description" id="activity_description" class="form-control">{{ old('activity_description') }}</textarea>
        </div>
        
            <button type="submit" class="btn btn-primary me-2">Submit</button>
            <a href="{{ route('bdm-activities.index', $lead->id) }}" class="btn btn-secondary">Cancel</a>
       
    </form>
</div>
@endsection
