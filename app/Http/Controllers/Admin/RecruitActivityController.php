<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\RecruitLead;
use App\Models\RecruitActivity;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RecruitActivityController extends Controller
{
    public function __construct()
    {
        $this->middleware(['permission:recruiter-data-list|recruiter-data-create|recruiter-data-edit|recruiter-data-delete'], ['only' => ['index', 'show']]);
        $this->middleware(['permission:recruiter-data-create'], ['only' => ['create', 'store']]);
        $this->middleware(['permission:recruiter-data-edit'], ['only' => ['edit', 'update']]);
        $this->middleware(['permission:recruiter-data-delete'], ['only' => ['destroy']]);
    }
    public function index(string $recruit_lead_id)
    {
        $lead = RecruitLead::findOrFail($recruit_lead_id);
        $activities = $lead->recruitActivities;

        return view('admin.recruiter.activity.index', compact('lead', 'activities', 'recruit_lead_id'));
    }

    /**
     * Show the form for creating a new recruit activity.
     */
    public function create(string $recruit_lead_id)
    {
        $lead = RecruitLead::findOrFail($recruit_lead_id);
        $activityTypes = ['phone call', 'email', 'whatsapp', 'others'];

        return view('admin.recruiter.activity.create', compact('lead', 'activityTypes'));
    }

    /**
     * Store a newly created recruit activity in storage.
     */
    public function store(Request $request, string $recruit_lead_id)
    {
        $request->validate([
            'activity_type' => 'required|in:phone call,email,whatsapp,others',
            'activity_description' => 'required|string',
        ]);

        $lead = RecruitLead::findOrFail($recruit_lead_id);

        $lead->recruitActivities()->create([
            'activity_type' => $request->activity_type,
            'activity_description' => $request->activity_description,
            'created_by' => Auth::guard('admin')->user()->name,
        ]);

        return redirect()->route('admin_recruit_activities.index', $recruit_lead_id)
                         ->with('success', 'Recruit activity added successfully!');
    }

    /**
     * Display a specific recruit activity.
     */
    public function show(string $id)
    {
        $recruitActivity = RecruitActivity::findOrFail($id);

        return view('admin.recruiter.activity.show', compact('recruitActivity'));
    }

    /**
     * Show the form for editing a specific recruit activity.
     */
    public function edit(string $recruit_lead_id, string $id)
    {
        $recruitActivity = RecruitActivity::where('id', $id)
                                          ->where('recruit_lead_id', $recruit_lead_id)
                                          ->firstOrFail();

        $activityTypes = ['phone call', 'email', 'whatsapp', 'others'];

        return view('admin.recruiter.activity.edit', compact('recruitActivity', 'activityTypes'));
    }

    /**
     * Update a specific recruit activity in storage.
     */
    public function update(Request $request, string $recruit_lead_id, string $id)
    {
        $request->validate([
            'activity_type' => 'required|in:phone call,email,whatsapp,others',
            'activity_description' => 'required|string',
        ]);

        $recruitActivity = RecruitActivity::where('id', $id)
                                          ->where('recruit_lead_id', $recruit_lead_id)
                                          ->firstOrFail();

        $recruitActivity->update([
            'activity_type' => $request->activity_type,
            'activity_description' => $request->activity_description,
            'updated_by' => Auth::guard('admin')->user()->name,
        ]);

        return redirect()->route('admin_recruit_activities.index', $recruit_lead_id)
                         ->with('success', 'Recruit activity updated successfully!');
    }

    /**
     * Remove a specific recruit activity from storage.
     */
    public function destroy(string $recruit_lead_id, string $activity_id)
    {
        $recruitActivity = RecruitActivity::where('id', $activity_id)
                                          ->where('recruit_lead_id', $recruit_lead_id)
                                          ->firstOrFail();

        $recruitActivity->delete();

        return redirect()->route('admin_recruit_activities.index', $recruit_lead_id)
                         ->with('success', 'Recruit activity deleted successfully!');
    }
}
