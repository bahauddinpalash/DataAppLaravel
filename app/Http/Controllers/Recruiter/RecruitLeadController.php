<?php

namespace App\Http\Controllers\Recruiter;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\RecruitLead;
use App\Models\Candidate;
use Illuminate\Support\Facades\Auth;

class RecruitLeadController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Fetch leads created by the logged-in recruiter
        $leads = RecruitLead::with('candidate')
            ->where('created_by', Auth::user()->name)
            ->get();

        return view('recruiter.lead.index', compact('leads'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Fetch all candidates
        $candidates = Candidate::all();

        // Pass candidates to the view
        return view('recruiter.lead.create', compact('candidates'));
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
            'position' => $request->position,
            'created_by' => Auth::user()->name,
            'remark' => $request->remark,
        ]);

        return redirect()->route('leads.index')->with('success', 'Lead created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $lead = RecruitLead::with('candidate')
            ->where('id', $id)
            ->where('created_by', Auth::user()->name)
            ->firstOrFail();

        return view('recruiter.lead.show', compact('lead'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $lead = RecruitLead::where('id', $id)
            ->where('created_by', Auth::user()->name)
            ->firstOrFail();

        $candidates = Candidate::all();
        return view('recruiter.lead.edit', compact('lead', 'candidates'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $lead = RecruitLead::where('id', $id)
            ->where('created_by', Auth::user()->name)
            ->firstOrFail();

        $request->validate([
            'candidate_id' => 'required|exists:candidates,id',
            'lead_status' => 'required|string|max:255',
            'candidate_meeting' => 'nullable|date',
            'remark' => 'nullable|string',
            'position' => 'required|string|max:255',
        ]);

        $lead->update([
            'candidate_id' => $request->candidate_id,
            'lead_status' => $request->lead_status,
            'candidate_meeting' => $request->candidate_meeting,
            'remark' => $request->remark,
            'position' => $request->position,
            'updated_by' => Auth::user()->name,
        ]);

        return redirect()->route('leads.index')->with('success', 'Lead updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $lead = RecruitLead::where('id', $id)
            ->where('created_by', Auth::user()->name)
            ->firstOrFail();

        $lead->delete();

        return redirect()->route('leads.index')->with('success', 'Lead deleted successfully.');
    }
}
