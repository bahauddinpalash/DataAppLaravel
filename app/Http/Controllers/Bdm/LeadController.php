<?php

namespace App\Http\Controllers\Bdm;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Client;
use App\Models\BdmLead;
use Illuminate\Support\Facades\Auth;

class LeadController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Fetch leads created by the logged-in BDM
        $leads = BdmLead::with('client')
            ->where('created_by', Auth::user()->name)
            ->paginate(10);

        return view('bdm.lead.index', compact('leads'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $clients = Client::all(); // Fetch all clients for dropdown
        return view('bdm.lead.create', compact('clients'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'client_id' => 'required|exists:clients,id',
            'lead_status' => 'required|string|max:255',
            'client_meeting' => 'nullable|date',
            'remark' => 'nullable|string|max:500',
        ]);

        // Create a new lead associated with the logged-in BDM
        BdmLead::create([
            'client_id' => $request->client_id,
            'lead_status' => $request->lead_status,
            'client_meeting' => $request->client_meeting,
            'created_by' => Auth::user()->name,
            'remark' => $request->remark,
        ]);

        return redirect()->route('bdm-leads.index')->with('success', 'Lead created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        // Fetch the lead if it was created by the logged-in BDM
        $lead = BdmLead::with('client')
            ->where('id', $id)
            ->where('created_by', Auth::user()->name)
            ->firstOrFail();

        return view('bdm.lead.show', compact('lead'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        // Fetch the lead if it was created by the logged-in BDM
        $lead = BdmLead::where('id', $id)
            ->where('created_by', Auth::user()->name)
            ->firstOrFail();

        $clients = Client::all(); // Fetch all clients for dropdown
        return view('bdm.lead.edit', compact('lead', 'clients'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'client_id' => 'required|exists:clients,id',
            'lead_status' => 'required|string|max:255',
            'client_meeting' => 'nullable|date',
            'remark' => 'nullable|string|max:500',
        ]);

        // Fetch the lead if it was created by the logged-in BDM
        $lead = BdmLead::where('id', $id)
            ->where('created_by', Auth::user()->name)
            ->firstOrFail();

        // Update lead data
        $lead->update([
            'client_id' => $request->client_id,
            'lead_status' => $request->lead_status,
            'client_meeting' => $request->client_meeting,
            'updated_by' => Auth::user()->name,
            'remark' => $request->remark,
        ]);

        return redirect()->route('bdm-leads.index')->with('success', 'Lead updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        // Fetch the lead if it was created by the logged-in BDM
        $lead = BdmLead::where('id', $id)
            ->where('created_by', Auth::user()->name)
            ->firstOrFail();

        $lead->delete();

        return redirect()->route('bdm-leads.index')->with('success', 'Lead deleted successfully.');
    }
}
