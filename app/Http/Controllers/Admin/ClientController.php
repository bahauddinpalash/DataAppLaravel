<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Client;
use Illuminate\Support\Facades\Auth;

class ClientController extends Controller
{
    public function __construct()
    {
        $this->middleware(['permission:client-list|client-create|client-edit|client-delete'], ['only' => ['index', 'show']]);
        $this->middleware(['permission:bdm-client-create'], ['only' => ['create', 'store']]);
        $this->middleware(['permission:client-edit'], ['only' => ['edit', 'update']]);
        $this->middleware(['permission:client-delete'], ['only' => ['destroy']]);
    }
    // Display all clients
    public function index()
    {
        $clients = Client::paginate(10);
        return view('admin.bdm.client.index', compact('clients'));
    }

    // Show form to create a new client
    public function create()
    {
        return view('admin.bdm.client.create');
    }

    // Store a new client
    public function store(Request $request)
    {
        $request->validate([
            'client_name' => 'required|string|max:255',
            'logo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'address' => 'required|string',
            'client_service_number' => 'required|string',
            'remarks' => 'nullable|string',
        ]);

        // Handle logo upload
        $logoPath = $request->hasFile('logo') ? $request->file('logo')->store('logos', 'public') : null;

        // Create the client
        Client::create([
            'client_name' => $request->client_name,
            'logo' => $logoPath,
            'address' => $request->address,
            'client_service_number' => $request->client_service_number,
            'created_by' => Auth::guard('admin')->user()->name, 
            'remarks' => $request->remarks,
        ]);

        return redirect()->route('bdm-clients.index')->with('success', 'Client created successfully.');
    }

    // Show the details of a specific client
    public function show($id)
    {
        $client = Client::findOrFail($id);
        return view('admin.bdm.client.show', compact('client'));
    }

    // Show form to edit a client
    public function edit($id)
    {
        $client = Client::findOrFail($id);
        return view('admin.bdm.client.edit', compact('client'));
    }

    // Update client information
    public function update(Request $request, $id)
    {
        $request->validate([
            'client_name' => 'required|string|max:255',
            'logo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'address' => 'required|string',
            'client_service_number' => 'required|string',
            'remarks' => 'nullable|string',
        ]);

        $client = Client::findOrFail($id);

        // Handle logo upload if present
        if ($request->hasFile('logo')) {
            $logoPath = $request->file('logo')->store('logos', 'public');
            $client->logo = $logoPath;
        }

        // Update client information
        $client->update([
            'client_name' => $request->client_name,
            'address' => $request->address,
            'client_service_number' => $request->client_service_number,
            'updated_by' => Auth::guard('admin')->user()->name, 
            'remarks' => $request->remarks,
        ]);

        return redirect()->route('bdm-clients.index')->with('success', 'Client updated successfully.');
    }

    // Delete a client
    public function destroy($id)
    {
        $client = Client::findOrFail($id);
        $client->delete();

        return redirect()->route('bdm-clients.index')->with('success', 'Client deleted successfully.');
    }
}
