<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ClientResponse;
use App\Models\BdmLead;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ClientsResponseController extends Controller
{
    public function __construct()
    {
        $this->middleware(['permission:bdm-data-list|bdm-data-create|bdm-data-edit|bdm-data-delete'], ['only' => ['index', 'show']]);
        $this->middleware(['permission:bdm-data-create'], ['only' => ['create', 'store']]);
        $this->middleware(['permission:bdm-data-edit'], ['only' => ['edit', 'update']]);
        $this->middleware(['permission:bdm-data-delete'], ['only' => ['destroy']]);
    }
    public function index($bdm_lead_id)
    {
        $lead = BdmLead::findOrFail($bdm_lead_id);
        $responses = $lead->clientResponses; // Assuming relationship is defined in the BdmLead model
        return view('admin.bdm.response.index', compact('lead', 'responses', 'bdm_lead_id'));
    }

    /**
     * Show the form for creating a new client response.
     */
    public function create(string $bdm_lead_id)
    {
        $lead = BdmLead::findOrFail($bdm_lead_id);
        $responseTypes = ['phone call', 'email', 'whatsapp', 'others'];
        return view('admin.bdm.response.create', compact('lead', 'responseTypes'));
    }

    /**
     * Store a newly created client response in storage.
     */
    public function store(Request $request, $bdm_lead_id)
    {
        $request->validate([
            'response_type' => 'required|in:phone call,email,whatsapp,others',
            'response_description' => 'required|string',
        ]);

        $lead = BdmLead::findOrFail($bdm_lead_id);

        $lead->clientResponses()->create([
            'response_type' => $request->response_type,
            'response_description' => $request->response_description,
            'received_by' => Auth::user()->name,
        ]);

        return redirect()->route('client-response.index', $bdm_lead_id)
                         ->with('success', 'Client response added successfully!');
    }

    /**
     * Show the form for editing the specified client response.
     */
    public function edit(string $bdm_lead_id, string $response_id)
    {
        $clientResponse = ClientResponse::where('id', $response_id)
                                        ->where('bdm_lead_id', $bdm_lead_id)
                                        ->with('bdmLead.client')
                                        ->firstOrFail();

        $responseTypes = ['phone call', 'email', 'whatsapp', 'others'];
        $clientId = $clientResponse->bdmLead->client->id;

        return view('admin.bdm.response.edit', compact('clientResponse', 'responseTypes', 'clientId', 'bdm_lead_id'));
    }

    /**
     * Update the specified client response in storage.
     */
    public function update(Request $request, string $bdm_lead_id, string $response_id)
    {
        $validatedData = $request->validate([
            'response_type' => 'required|string|in:phone call,email,whatsapp,others',
            'response_description' => 'required|string|max:500',
        ]);

        $clientResponse = ClientResponse::where('id', $response_id)
                                        ->where('bdm_lead_id', $bdm_lead_id)
                                        ->firstOrFail();

        $clientResponse->update([
            'response_type' => $validatedData['response_type'],
            'response_description' => $validatedData['response_description'] ?? null,
            'updated_by' => Auth::user()->name,
        ]);

        return redirect()->route('client-response.index', ['bdm_lead_id' => $bdm_lead_id])
                         ->with('success', 'Client response updated successfully.');
    }

    /**
     * Remove the specified client response from storage.
     */
    public function destroy(string $bdm_lead_id, string $response_id)
    {
        $clientResponse = ClientResponse::where('id', $response_id)
                                        ->where('bdm_lead_id', $bdm_lead_id)
                                        ->firstOrFail();

        $clientResponse->delete();

        return redirect()->route('client-response.index', ['bdm_lead_id' => $bdm_lead_id])
                         ->with('success', 'Client response deleted successfully.');
    }
}
