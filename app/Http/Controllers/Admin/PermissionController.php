<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class PermissionController extends Controller
{
    public function index() {
        $permissions = Permission::all();
        return view('admin.permissions.index', [
            'permissions' => $permissions
        ]);
    }

    public function create() {
        return view('admin.permissions.create');
    }

    public function store(Request $request) {
        $validated = $request->validate(['name' => ['required', 'min:3']]);
        Permission::create($validated);
        return to_route('admin.permissions.index')->with('message', 'Permission created with success');;
    }

    public function edit(int $id) {
        $permission = Permission::findById($id);
        $roles = Role::all();
        return view('admin.permissions.edit', [
            'permission' => $permission,
            'roles' => $roles
        ]);
    }

    public function update(Request $request, int $id) {
        $permission = Permission::findById($id);
        $validated = $request->validate(['name' => ['required', 'min:3']]);
        $permission->update($validated);
        return to_route('admin.permissions.index')->with('message', 'Permission updated with success');
    }

    public function destroy(int $id) {
        $permission = Permission::findById($id);
        $permission->delete();
        return to_route('admin.permissions.index')->with('message', 'Permission deleted with success');
    }

    public function assignRole(Request $request, int $id) {
        $permission = Permission::findById($id);
        if($permission->hasRole($request->get('role'))) {
            return back()->with('message', 'Role already assigned');
        }
        $permission->assignRole($request->get('role'));
        return back()->with('message', 'Role assign with success');
    }

    public function removeRole(int $permissionId, int $roleId) {
        $role = Role::findById($roleId);
        $permission = Permission::findById($permissionId);
        $permission->removeRole($role);
        return back()->with('message', 'Role removed with success');
    }
}
