<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Client;
use App\Models\BdmLead;
use Illuminate\Support\Facades\Auth;

class BdmLeadController extends Controller
{
    public function __construct()
    {
        $this->middleware(['permission:bdm-data-list|bdm-data-create|bdm-data-edit|bdm-data-delete'], ['only' => ['index', 'show']]);
        $this->middleware(['permission:bdm-data-create'], ['only' => ['create', 'store']]);
        $this->middleware(['permission:bdm-data-edit'], ['only' => ['edit', 'update']]);
        $this->middleware(['permission:bdm-data-delete'], ['only' => ['destroy']]);
    }
    public function index()
    { 
        $leads = BdmLead::with('client')->paginate(10);
        return view('admin.bdm.lead.index', compact('leads'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $clients = Client::all();
        return view('admin.bdm.lead.create', compact('clients'));
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
            'remark' => 'nullable|string',
        ]);

        BdmLead::create([
            'client_id' => $request->client_id,
            'lead_status' => $request->lead_status,
            'client_meeting' => $request->client_meeting,
            'created_by' => Auth::user()->name,
            'remark' => $request->remark,
        ]);

        return redirect()->route('admin-bdm-leads.index')->with('success', 'Lead created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $lead = BdmLead::with('client')->findOrFail($id);
        return view('admin.bdm.lead.show', compact('lead'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $lead = BdmLead::findOrFail($id);
        $clients = Client::all();
        return view('admin.bdm.lead.edit', compact('lead', 'clients'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'client_id' => 'required|exists:clients,id',
            'lead_status' => 'required|string|max:255',
            'client_meeting' => 'nullable|date',
            'remark' => 'nullable|string',
        ]);

        $lead = BdmLead::findOrFail($id);

        $lead->update([
            'client_id' => $request->client_id,
            'lead_status' => $request->lead_status,
            'client_meeting' => $request->client_meeting,
            'updated_by' => Auth::user()->name,
            'remark' => $request->remark,
        ]);

        return redirect()->route('admin-bdm-leads.index')->with('success', 'Lead updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $lead = BdmLead::findOrFail($id);
        $lead->delete();

        return back()->with('success', 'Lead deleted successfully.');
    }
}
