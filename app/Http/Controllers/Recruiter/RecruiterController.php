<?php

namespace App\Http\Controllers\Recruiter;

use App\Models\Recruiter;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash; 

class RecruiterController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:recruiter-list', ['only' => ['index', 'show']]);
        $this->middleware('permission:recruiter-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:recruiter-edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:recruiter-delete', ['only' => ['destroy']]);
    }
    public function index()
    {
        $recruiters = Recruiter::all();
        return view('user.recruiter.index', compact('recruiters'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('user.recruiter.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:recruiters,email',
            'password' => 'required|string|min:8|confirmed',
        ]);

        Recruiter::create([
            'name' => $validatedData['name'],
            'email' => $validatedData['email'],
            'password' => Hash::make($validatedData['password']),
        ]);

        return redirect()->route('recruiters.index')->with('success', 'Recruiter created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $recruiter = Recruiter::findOrFail($id);
        return view('user.recruiter.show', compact('recruiter'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $recruiter = Recruiter::findOrFail($id);
        return view('user.recruiter.edit', compact('recruiter'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $recruiter = Recruiter::findOrFail($id);

        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:recruiters,email,' . $id,
            'password' => 'nullable|string|min:8|confirmed',
        ]);

        $recruiter->update([
            'name' => $validatedData['name'],
            'email' => $validatedData['email'],
            'password' => $validatedData['password'] ? Hash::make($validatedData['password']) : $recruiter->password,
        ]);

        return redirect()->route('recruiters.index')->with('success', 'Recruiter updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $recruiter = Recruiter::findOrFail($id);
        $recruiter->delete();

        return redirect()->route('recruiters.index')->with('success', 'Recruiter deleted successfully.');
    }
}
