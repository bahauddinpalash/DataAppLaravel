<?php

namespace App\Http\Controllers\Recruiter;

use App\Http\Controllers\Controller;
use App\Models\RecruitLead;
use App\Models\RecruitActivity;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RecruitActivityController extends Controller
{
    /**
     * Display a listing of the recruit activities.
     */
    public function index(string $recruit_lead_id)
    {
        // Fetch the recruit lead by its ID
        $lead = RecruitLead::findOrFail($recruit_lead_id);
        
        // Retrieve all recruit activities related to the lead
        $activities = $lead->recruitActivities; // Assuming the relationship is defined in the RecruitLead model
        
        // Pass the lead and activities to the view
        return view('recruiter.activity.index', compact('lead', 'activities', 'recruit_lead_id'));
    }

    /**
     * Show the form for creating a new recruit activity.
     */
    public function create(string $recruit_lead_id)
    {
        // Fetch the recruit lead by its ID
        $lead = RecruitLead::findOrFail($recruit_lead_id);
        
        // Define possible activity types
        $activityTypes = ['phone call', 'email', 'whatsapp', 'others'];
        
        // Pass the lead and activity types to the view
        return view('recruiter.activity.create', compact('lead', 'activityTypes'));
    }

    /**
     * Store a newly created recruit activity in storage.
     */
    public function store(Request $request, string $recruit_lead_id)
    {
        // Validate the incoming request
        $request->validate([
            'activity_type' => 'required|in:phone call,email,whatsapp,others',
            'activity_description' => 'required|string',
        ]);

        // Fetch the recruit lead by its ID
        $lead = RecruitLead::findOrFail($recruit_lead_id);

        // Create the new recruit activity
        $lead->recruitActivities()->create([
            'activity_type' => $request->activity_type,
            'activity_description' => $request->activity_description,
            'created_by' => Auth::user()->name,
        ]);

        // Redirect to the lead activities page with a success message
        return redirect()->route('recruit_activities.index', $recruit_lead_id)
                         ->with('success', 'Recruit activity added successfully!');
    }

    /**
     * Display the specified recruit activity.
     */
    public function show(string $id)
    {
        // Fetch the recruit activity by its ID
        $recruitActivity = RecruitActivity::findOrFail($id);
        
        // Pass the recruit activity to the view
        return view('recruiter.activity.show', compact('recruitActivity'));
    }

    /**
     * Show the form for editing the specified recruit activity.
     */
    public function edit(string $recruit_lead_id, string $id)
    {
        // Fetch the recruit activity by its ID and the related lead ID
        $recruitActivity = RecruitActivity::where('id', $id)
                                          ->where('recruit_lead_id', $recruit_lead_id)
                                           
                                          ->firstOrFail();
                                          
        // Define possible activity types
        $activityTypes = ['phone call', 'email', 'whatsapp', 'others'];
  
        // Pass the recruit activity, activity types, and lead data to the view
        return view('recruiter.activity.edit', compact('recruitActivity', 'activityTypes'));
    }

    /**
     * Update the specified recruit activity in storage.
     */
    public function update(Request $request, string $recruit_lead_id, string $id)
    {
        // Validate the incoming request
        $request->validate([
            'activity_type' => 'required|in:phone call,email,whatsapp,others',
            'activity_description' => 'required|string',
        ]);

        // Fetch the recruit activity by its ID and the related lead ID
        $recruitActivity = RecruitActivity::where('id', $id)
                                          ->where('recruit_lead_id', $recruit_lead_id)
                                          ->firstOrFail();

        // Update the recruit activity with the new data
        $recruitActivity->update([
            'activity_type' => $request->activity_type,
            'activity_description' => $request->activity_description,
            'updated_by' => Auth::user()->name,
        ]);

        // Redirect to the lead activities page with a success message
        return redirect()->route('recruit_activities.index', $recruit_lead_id)
                         ->with('success', 'Recruit activity updated successfully!');
    }

    /**
     * Remove the specified recruit activity from storage.
     */
    public function destroy(string $recruit_lead_id, string $activity_id)
    {
        // Fetch and delete the recruit activity by its ID and the related lead ID
        $recruitActivity = RecruitActivity::where('id', $activity_id)
                                          ->where('recruit_lead_id', $recruit_lead_id)
                                          ->firstOrFail();
        $recruitActivity->delete();

        // Redirect to the lead activities page with a success message
        return redirect()->route('recruit_activities.index', ['recruit_lead_id' => $recruit_lead_id])
                         ->with('success', 'Recruit activity deleted successfully!');
    }
}
