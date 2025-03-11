<?php

namespace App\Http\Controllers\Admin;

use App\Models\Candidate;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class CandidatesController extends Controller
{
    public function __construct()
    {
        $this->middleware(['permission:candidate-list|candidate-create|candidate-edit|candidate-delete'], ['only' => ['index', 'show']]);
        $this->middleware(['permission:candidate-create'], ['only' => ['create', 'store']]);
        $this->middleware(['permission:candidate-edit'], ['only' => ['edit', 'update']]);
        $this->middleware(['permission:candidate-delete'], ['only' => ['destroy']]);
    }
    public function index(Request $request)
{
    $position = $request->input('position');
    $createdBy = $request->input('created_by');
    $dateFilter = $request->input('date_filter');
    $startDate = $request->input('start_date');
    $endDate = $request->input('end_date');

    $candidates = Candidate::query();

    if ($position) {
        $candidates->where('position', $position);
    }

    if ($createdBy) {
        $candidates->where('created_by', $createdBy);
    }

    if ($dateFilter) {
        if ($dateFilter === 'today') {
            $candidates->whereDate('created_at', now()->toDateString());
        } elseif ($dateFilter === 'week') {
            $candidates->whereBetween('created_at', [now()->startOfWeek(), now()->endOfWeek()]);
        } elseif ($dateFilter === 'month') {
            $candidates->whereMonth('created_at', now()->month);
        } elseif ($dateFilter === 'custom' && $startDate && $endDate) {
            $candidates->whereBetween('created_at', [$startDate, $endDate]);
        }
    }

    $positions = Candidate::select('position')->distinct()->pluck('position');
    $creators = Candidate::select('created_by')->distinct()->pluck('created_by');

    $candidates = $candidates->paginate(10);

    return view('admin.recruiter.candidate.index', compact('candidates', 'positions', 'creators', 'position', 'createdBy', 'dateFilter'));
}


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.recruiter.candidate.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:candidates,email',
            'contact_number' => 'required|string|max:15',
            'age' => 'required|integer|min:18',
            'nationality' => 'required|string|max:255',
            'marital_status' => 'required|string|max:50',
            'total_experience' => 'required|integer|min:0',
            'relevant_experience' => 'required|integer|min:0',
            'current_salary' => 'required|numeric|min:0',
            'expected_salary' => 'required|numeric|min:0',
            'highest_qualification' => 'required|string|max:255',
            'notice_period' => 'required|string|max:50',
            'interview_availability' => 'required|string|max:255',
            // 'visa_type' => 'required|string|max:255',
            // 'visa_expiry_date' => 'required|date',
            // 'current_location' => 'required|string|max:255',
            'job_change_reason' => 'required|string|max:255',
            'cv' => 'nullable|file|mimes:pdf,doc,docx|max:2048',
            'position' => 'required|string|max:255',
        ]);

        $cvPath = $request->hasFile('cv') ? $request->file('cv')->store('cvs', 'public') : null;

        Candidate::create([
            'name' => $request->name,
            'email' => $request->email,
            'contact_number' => $request->contact_number,
            'age' => $request->age,
            'nationality' => $request->nationality,
            'marital_status' => $request->marital_status,
            'total_experience' => $request->total_experience,
            'relevant_experience' => $request->relevant_experience,
            'current_salary' => $request->current_salary,
            'expected_salary' => $request->expected_salary,
            'highest_qualification' => $request->highest_qualification,
            'notice_period' => $request->notice_period,
            'interview_availability' => $request->interview_availability,
            'visa_type' => $request->visa_type,
            'visa_expiry_date' => $request->visa_expiry_date,
            'current_location' => $request->current_location,
            'job_change_reason' => $request->job_change_reason,
            'position' => $request->position,
            'created_by' => Auth::user()->name, 
            'cv' => $cvPath,
        ]);

        return redirect()->route('admin-candidates.index')->with('success', 'Candidate added successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $candidate = Candidate::findOrFail($id);
        return view('admin.recruiter.candidate.show', compact('candidate'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $candidate = Candidate::findOrFail($id);
        return view('admin.recruiter.candidate.edit', compact('candidate'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $candidate = Candidate::findOrFail($id);

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:candidates,email,' . $candidate->id,
            'contact_number' => 'required|string|max:15',
            'age' => 'required|integer|min:18',
            'nationality' => 'required|string|max:255',
            'marital_status' => 'required|string|max:50',
            'total_experience' => 'required|integer|min:0',
            'relevant_experience' => 'required|integer|min:0',
            'current_salary' => 'required|numeric|min:0',
            'expected_salary' => 'required|numeric|min:0',
            'highest_qualification' => 'required|string|max:255',
            'notice_period' => 'required|string|max:50',
            'interview_availability' => 'required|string|max:255',
            'visa_type' => 'required|string|max:255',
            'visa_expiry_date' => 'required|date',
            'current_location' => 'required|string|max:255',
            'job_change_reason' => 'required|string|max:255',
            'position' => 'required|string|max:255',
            'cv' => 'nullable|file|mimes:pdf,doc,docx|max:2048',
        ]);

        if ($request->hasFile('cv')) {
            $cvPath = $request->file('cv')->store('cvs', 'public');
            $candidate->cv = $cvPath;
        }

        $candidate->update($request->except(['cv']) + ['updated_by' => Auth::user()->name]);

        return redirect()->route('admin-candidates.index')->with('success', 'Candidate updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $candidate = Candidate::findOrFail($id);
        $candidate->delete();

        return redirect()->route('admin-candidates.index')->with('success', 'Candidate deleted successfully.');
    }
}
