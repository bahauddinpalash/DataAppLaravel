<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\RecruitLead;
use App\Models\Candidate;
use Illuminate\Support\Facades\Auth;

class RecruitLeadController extends Controller
{
    public function __construct()
    {
        $this->middleware(['permission:recruiter-data-list|recruiter-data-create|recruiter-data-edit|recruiter-data-delete'], ['only' => ['index', 'show']]);
        $this->middleware(['permission:recruiter-data-create'], ['only' => ['create', 'store']]);
        $this->middleware(['permission:recruiter-data-edit'], ['only' => ['edit', 'update']]);
        $this->middleware(['permission:recruiter-data-delete'], ['only' => ['destroy']]);
    }
    public function index()
    {
        $leads = RecruitLead::with('candidate')->paginate(10);
        return view('admin.recruiter.lead.index', compact('leads'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Fetch all candidates
        $candidates = Candidate::all();
        
        // Pass candidates to the view
        return view('admin.recruiter.lead.create', compact('candidates'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'candidate_id' => 'required|exists:candidates,id',
            'lead_status' => 'required|string|max:255',
            'candidate_meeting' => 'nullable|date',
            'remark' => 'nullable|string',
            'position' => 'required|string|max:255',
        ]);

        // Create a new RecruitLead
        RecruitLead::create([
            'candidate_id' => $request->candidate_id,
            'lead_status' => $request->lead_status,
            'candidate_meeting' => $request->candidate_meeting,
            'created_by' => Auth::user()->name,
            'remark' => $request->remark,
            'position' => $request->position,
        ]);

        return redirect()->route('admin-recruit-leads.index')->with('success', 'Lead created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $lead = RecruitLead::with('candidate')->findOrFail($id);
        return view('admin.recruiter.lead.show', compact('lead'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $lead = RecruitLead::findOrFail($id);
        $candidates = Candidate::all(); // Fetch all candidates
        return view('admin.recruiter.lead.edit', compact('lead', 'candidates'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'candidate_id' => 'required|exists:candidates,id',
            'lead_status' => 'required|string|max:255',
            'candidate_meeting' => 'nullable|date',
            'remark' => 'nullable|string',
            'position' => 'required|string|max:255',
        ]);

        $lead = RecruitLead::findOrFail($id);
        
        // Update the RecruitLead
        $lead->update([
            'candidate_id' => $request->candidate_id,
            'lead_status' => $request->lead_status,
            'candidate_meeting' => $request->candidate_meeting,
            'updated_by' => Auth::user()->name,
            'remark' => $request->remark,
            'position' => $request->position,
        ]);

        return redirect()->route('admin-recruit-leads.index')->with('success', 'Lead updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $lead = RecruitLead::findOrFail($id);
        $lead->delete();

        return back()->with('success', 'Lead deleted successfully.');
    }
}