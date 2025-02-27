@extends('bdm.layouts.app')   
@section('content')
    <div class="container mt-5">
        <h1>Add Sales Activity for Lead: {{ $lead->client->client_name }}</h1>
        
        <form action="{{ route('sales_activities.store', $lead->id) }}" method="POST">
            @csrf
            <div class="form-group mb-3">
                <label for="activity_type">Activity Type</label>
                <select name="activity_type" id="activity_type" class="form-control">
                    <option value="">Select Activity Type</option>
                    @foreach ($activityTypes as $type)
                        <option value="{{ $type }}">{{ ucfirst($type) }}</option>
                    @endforeach
                </select>
                @error('activity_type')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group mb-3">
                <label for="activity_description">Activity Description</label>
                <textarea name="activity_description" id="activity_description" rows="4" class="form-control"></textarea>
                @error('activity_description')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            {{-- <div class="form-group mb-3">
                <label for="activity_date">Activity Date</label>
                <input type="datetime-local" name="activity_date" id="activity_date" class="form-control" value="{{ old('activity_datetime') }}">
                @error('activity_date')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div> --}}

            <button type="submit" class="btn btn-primary">Save Activity</button>
        </form>
    </div>
    @endsection
