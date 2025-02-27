 @extends('admin.layouts.app')

@section('content')
<div class="container">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h1 class="h4 mt-2">BDM List</h1>
        <a href="{{ route('bdms.create') }}" class="btn btn-primary mt-2">Add New BDM</a>
    </div>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <div class="table-responsive">
        <table class="table table-bordered table-striped">
            <thead class="table-dark">
                <tr>
                    
                    <th>Name</th>
                    <th>Email</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($bdms as $bdm)
                    <tr>
                        
                        <td>{{ $bdm->name }}</td>
                        <td>{{ $bdm->email }}</td>
                        
                       
                        <td>
                            <a href="{{ route('bdms.show', $bdm->id) }}" class="btn btn-sm btn-info">View</a>
                            <a href="{{ route('bdms.edit', $bdm->id) }}" class="btn btn-sm btn-warning">Edit</a>
                            <form action="{{ route('bdms.destroy', $bdm->id) }}" method="POST" style="display: inline-block;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure you want to delete this BDM?');">Delete</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="text-center">No BDMs found.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
