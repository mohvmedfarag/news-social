<?php

namespace App\Http\Controllers\Admin\Role;

use App\Http\Controllers\Controller;
use App\Models\Role;
use Illuminate\Http\Request;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $order_by = request()->order_by ?? 'desc';
        $sort_by = request()->sort_by ?? 'id';
        $limit_by = request()->limit_by ?? 5;

        $roles = Role::select('id', 'role', 'permissions')
            ->when(request()->keyword, function ($query) {
                $query->where('role', 'LIKE', '%'.request()->keyword.'%');
            });

        $roles = $roles->orderBy($sort_by, $order_by)->paginate($limit_by);

        return view('admin.roles.index', compact('roles'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.roles.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'role' => 'required|string',
            'permissions' => 'required|array|min:1',
        ]);

        Role::create([
            'role' => $data['role'],
            'permissions' => json_encode($data['permissions']),
        ]);

        return redirect()->back()->with('success', 'Role Created Successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Role $role)
    {
        return view('admin.roles.edit', compact('role'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Role $role)
    {
        $data = $request->validate([
            'role' => 'required|string|max:255',
            'permissions' => 'required|array|min:1',
        ]);

        $updated = $role->update([
            'role' => $data['role'],
            'permissions' => json_encode($data['permissions']),
        ]);

        if (! $updated) {
            return redirect()->back()->with('error', 'Something went wrong, try again later!');
        }

        return redirect()->route('admin.roles.index')
            ->with('success', 'Role updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $role = Role::findOrFail($id);
        $role = $role->delete();
        if (! $role) {
            return redirect()->back()->with('error', 'try Again Latter!');
        }

        return redirect()->back()->with('success', 'role Deleted Successfully!');
    }
}
