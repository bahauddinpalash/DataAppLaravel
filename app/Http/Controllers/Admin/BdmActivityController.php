<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SalesActivity;
use App\Models\BdmLead;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BdmActivityController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index($bdm_lead_id)
    {
        $lead = BdmLead::findOrFail($bdm_lead_id);
        $activities = $lead->salesActivities;
        return view('admin.bdm.activity.index', compact('lead', 'activities', 'bdm_lead_id'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create($bdm_lead_id)
    {
        $lead = BdmLead::findOrFail($bdm_lead_id);
        $activityTypes = ['phone call', 'email', 'whatsapp', 'others'];

        return view('admin.bdm.activity.create', compact('lead', 'activityTypes'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, $bdm_lead_id)
    {
        $request->validate([
            'activity_type' => 'required|in:phone call,email,whatsapp,others',
            'activity_description' => 'required|string',
        ]);

        $lead = BdmLead::findOrFail($bdm_lead_id);

        $lead->salesActivities()->create([
            'activity_type' => $request->activity_type,
            'activity_description' => $request->activity_description,
            'created_by' => Auth::user()->name,
        ]);

        return redirect()->route('bdm-activities.index', $bdm_lead_id)
                         ->with('success', 'Sales activity added successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show($bdm_lead_id, $id)
    {
        $salesActivity = SalesActivity::where('id', $id)
                                      ->where('bdm_lead_id', $bdm_lead_id)
                                      ->firstOrFail();

        return view('admin.bdm.activity.show', compact('salesActivity'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($bdm_lead_id, $id)
    {
        $salesActivity = SalesActivity::where('id', $id)
                                      ->where('bdm_lead_id', $bdm_lead_id)
                                      ->with('lead.client')
                                      ->firstOrFail();
        $activityTypes = ['phone call', 'email', 'whatsapp', 'others'];
        $clientId = $salesActivity->lead->client->id;

        return view('admin.bdm.activity.edit', compact('salesActivity', 'activityTypes', 'clientId'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $bdm_lead_id, $id)
    {
        $request->validate([
            'activity_type' => 'required|in:phone call,email,whatsapp,others',
            'activity_description' => 'required|string',
        ]);

        $salesActivity = SalesActivity::where('id', $id)
                                      ->where('bdm_lead_id', $bdm_lead_id)
                                      ->firstOrFail();

        $salesActivity->update([
            'activity_type' => $request->activity_type,
            'activity_description' => $request->activity_description,
            'updated_by' => Auth::user()->name,
        ]);

        return redirect()->route('bdm-activities.index', $bdm_lead_id)
                         ->with('success', 'Sales activity updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($bdm_lead_id, $activity_id)
    {
        $salesActivity = SalesActivity::where('id', $activity_id)
                                      ->where('bdm_lead_id', $bdm_lead_id)
                                      ->firstOrFail();
        $salesActivity->delete();

        return redirect()->route('bdm-activities.index', $bdm_lead_id)
                         ->with('success', 'Sales activity deleted successfully!');
    }
}
