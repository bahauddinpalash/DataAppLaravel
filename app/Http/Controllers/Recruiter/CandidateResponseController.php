<?php

namespace App\Http\Controllers\Recruiter;

use App\Http\Controllers\Controller;
use App\Models\RecruitLead;
use App\Models\CandidateResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CandidateResponseController extends Controller
{
    /**
     * Display a listing of the candidate responses.
     */
    public function index($recruit_lead_id)
    {
        $lead = RecruitLead::findOrFail($recruit_lead_id);
        $responses = $lead->candidateResponses; // Assuming relationship is defined in the RecruitLead model
        return view('recruiter.response.index', compact('lead', 'responses', 'recruit_lead_id'));
    }

    /**
     * Show the form for creating a new candidate response.
     */
    public function create(string $recruit_lead_id)
    {
        $lead = RecruitLead::findOrFail($recruit_lead_id);
        $responseTypes = ['phone call', 'email', 'interview', 'others'];
        return view('recruiter.response.create', compact('lead', 'responseTypes'));
    }

    /**
     * Store a newly created candidate response in storage.
     */
    public function store(Request $request, $recruit_lead_id)
    { 
        $request->validate([
            'response_type' => 'required|in:phone call,email,interview,others',
            'response_description' => 'required|string',
        ]);

        $lead = RecruitLead::findOrFail($recruit_lead_id);

        $lead->candidateResponses()->create([
            'response_type' => $request->response_type,
            'response_description' => $request->response_description,
            'received_by' => Auth::user()->name,
        ]);

        return redirect()->route('candidate_responses.index', $recruit_lead_id)
                         ->with('success', 'Candidate response added successfully!');
    }

    /**
     * Show the form for editing the specified candidate response.
     */
    public function edit(string $recruit_lead_id, string $response_id)
    {
        $candidateResponse = CandidateResponse::where('id', $response_id)
                                              ->where('recruit_lead_id', $recruit_lead_id)
                                              ->with('recruitLead.candidate') // Load the associated candidate
                                              ->firstOrFail();

        $responseTypes = ['phone call', 'email', 'interview', 'others'];
        $candidateId = $candidateResponse->recruitLead->candidate->id;

        return view('recruiter.response.edit', compact('candidateResponse', 'responseTypes', 'candidateId', 'recruit_lead_id'));
    }

    /**
     * Update the specified candidate response in storage.
     */
    public function update(Request $request, string $recruit_lead_id, string $response_id)
    {
        $validatedData = $request->validate([
            'response_type' => 'required|string|in:phone call,email,interview,others',
            'response_description' => 'nullable|string|max:500',
        ]);

        $candidateResponse = CandidateResponse::where('id', $response_id)
                                              ->where('recruit_lead_id', $recruit_lead_id)
                                              ->firstOrFail();

        $candidateResponse->update([
            'response_type' => $validatedData['response_type'],
            'response_description' => $validatedData['response_description'] ?? null,
            'updated_by' => Auth::user()->name,
        ]);

        return redirect()->route('candidate_responses.index', ['recruit_lead_id' => $recruit_lead_id])
                         ->with('success', 'Candidate response updated successfully.');
    }

    /**
     * Remove the specified candidate response from storage.
     */
    public function destroy(string $recruit_lead_id, string $response_id)
    {
        $candidateResponse = CandidateResponse::where('id', $response_id)
                                              ->where('recruit_lead_id', $recruit_lead_id)
                                              ->firstOrFail();

        $candidateResponse->delete();

        return redirect()->route('candidate_responses.index', ['recruit_lead_id' => $recruit_lead_id])
                         ->with('success', 'Candidate response deleted successfully.');
    }
}
