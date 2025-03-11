<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RoleController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:recruiter-data-list|recruiter-data-create|recruiter-data-edit|recruiter-data-delete')->only(['index', 'show']);
        $this->middleware('permission:recruiter-data-create')->only(['create', 'store']);
        $this->middleware('permission:recruiter-data-edit')->only(['edit', 'update']);
        $this->middleware('permission:recruiter-data-delete')->only(['destroy']);
    }
    public function index()
    {
        $roles = Role::all();
        return view('roles.index', compact('roles'));
    }

    /**
     * Show the form for creating a new role.
     */
    public function create()
    {
        $permissions = Permission::all(); // Fetch all permissions
        return view('roles.create', compact('permissions'));
    }

    /**
     * Store a newly created role in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:roles,name',
        ]);

        // Create the role
        $role = Role::create(['name' => $request->name]);

        // Sync permissions to the role
        if ($request->has('permissions')) {
            $role->syncPermissions($request->permissions);
        }

        return redirect()->route('roles.index')
                         ->with('success', 'Role created successfully.');
    }

    /**
     * Display the specified role.
     */
    public function show(string $id)
    {
        $role = Role::findOrFail($id);
        return view('roles.show', compact('role'));
    }

    /**
     * Show the form for editing the specified role.
     */
    public function edit(string $id)
    {
        $role = Role::findOrFail($id);
        $permissions = Permission::all();
        return view('roles.edit', compact('role', 'permissions'));
    }

    /**
     * Update the specified role in storage.
     */
    public function update(Request $request, string $id)
    {
        // // Debug incoming data
        // dd($request->all());
    
        $role = Role::findOrFail($id);
    
        // Update role name
        $role->name = $request->input('name');
        $role->save();
    
        // Update permissions
        if ($request->has('permissions')) {
            $permissions = Permission::whereIn('id', $request->permissions)->get();
            $role->syncPermissions($permissions);
        } else {
            $role->syncPermissions([]); // Remove all permissions if none are selected
        }
    
        return redirect()->route('roles.index')->with('success', 'Role updated successfully.');
    }
    
    /**
     * Remove the specified role from storage.
     */
    public function destroy(string $id)
    {
        $role = Role::findOrFail($id);
        $role->delete();

        return redirect()->route('roles.index')
                         ->with('success', 'Role deleted successfully.');
    }
}
