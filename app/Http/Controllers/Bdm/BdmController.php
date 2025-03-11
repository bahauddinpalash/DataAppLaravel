<?php

namespace App\Http\Controllers\Bdm;

use App\Models\Bdm;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash; 

class BdmController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:bdm-list', ['only' => ['index', 'show']]);
        $this->middleware('permission:bdm-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:bdm-edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:bdm-delete', ['only' => ['destroy']]);
    }
    public function index()
    {
        $bdms = Bdm::all();
        return view('user.bdm.index', compact('bdms'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('user.bdm.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:bdms,email',
            'password' => 'required|string|min:8|confirmed',
        ]);

        Bdm::create([
            'name' => $validatedData['name'],
            'email' => $validatedData['email'],
            'password' => Hash::make($validatedData['password']),
        ]);

        return redirect()->route('bdms.index')->with('success', 'BDM created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $bdm = Bdm::findOrFail($id);
        return view('user.bdm.show', compact('bdm'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $bdm = Bdm::findOrFail($id);
        return view('user.bdm.edit', compact('bdm'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $bdm = Bdm::findOrFail($id);

        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:bdms,email,' . $id,
            'password' => 'nullable|string|min:8|confirmed',
        ]);

        $bdm->update([
            'name' => $validatedData['name'],
            'email' => $validatedData['email'],
            'password' => $validatedData['password'] ? Hash::make($validatedData['password']) : $bdm->password,
        ]);

        return redirect()->route('bdms.index')->with('success', 'BDM updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $bdm = Bdm::findOrFail($id);
        $bdm->delete();

        return redirect()->route('bdms.index')->with('success', 'BDM deleted successfully.');
    }
}
