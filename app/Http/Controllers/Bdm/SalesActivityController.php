<?php

namespace App\Http\Controllers\Bdm;

use App\Http\Controllers\Controller;
use App\Models\SalesActivity;
use App\Models\BdmLead;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SalesActivityController extends Controller
{
    /**
     * Display a listing of the sales activities.
     */
    public function index($bdm_lead_id)
    {
        $lead = BdmLead::findOrFail($bdm_lead_id);
        $activities = $lead->salesActivities; // Assuming relationship is defined in the Lead model
        return view('bdm.activity.index', compact('lead', 'activities', 'bdm_lead_id')); // Passing $lead_id to the view
    }

    /**
     * Show the form for creating a new sales activity.
     */
    public function create(string $bdm_lead_id)
    {
        $lead = BdmLead::findOrFail($bdm_lead_id);
        $activityTypes = ['phone call', 'email', 'whatsapp', 'others'];

        return view('bdm.activity.create', compact('lead', 'activityTypes'));
    }

    /**
     * Store a newly created sales activity in storage.
     */
    public function store(Request $request, string $bdm_lead_id)
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

        return redirect()->route('bdm-leads.index', $bdm_lead_id)
                         ->with('success', 'Sales activity added successfully!');
    }

    /**
     * Display the specified sales activity.
     */
    public function show(string $id)
    {
        $salesActivity = SalesActivity::findOrFail($id);
        return view('bdm.sales_activities.show', compact('salesActivity'));
    }

    /**
     * Show the form for editing the specified sales activity.
     */
    public function edit(string $bdm_lead_id, string $id)
{
    $salesActivity = SalesActivity::where('id', $id)
                                  ->where('bdm_lead_id', $bdm_lead_id)
                                  ->with('lead.client') // Ensure related client data is loaded
                                  ->firstOrFail();
    $activityTypes = ['phone call', 'email', 'whatsapp', 'others'];
    $clientId = $salesActivity->lead->client->id; // Access the client ID through relationships

    return view('bdm.activity.edit', compact('salesActivity', 'activityTypes', 'clientId'));
}

  /**
 * Update the specified sales activity in storage.
 */
public function update(Request $request, string $bdm_lead_id, string $id)
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

    return redirect()->route('sales_activities.index', $bdm_lead_id)
                     ->with('success', 'Sales activity updated successfully!');
}


    /**
     * Remove the specified sales activity from storage.
     */
    public function destroy(string $bdm_lead_id, string $activity_id)
    {
        $salesActivity = SalesActivity::where('id', $activity_id)
                                             ->where('bdm_lead_id', $bdm_lead_id)
                                             ->firstOrFail();
        $salesActivity->delete();

        return redirect()->route('sales_activities.index', ['bdm_lead_id' => $bdm_lead_id])
                         ->with('success', 'Sales activity deleted successfully!');
    }
}
