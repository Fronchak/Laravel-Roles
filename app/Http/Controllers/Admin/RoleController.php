<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleController extends Controller
{
    public function index() {
        $roles = Role::whereNotIn('name', ['admin'])->get();
        return view('admin.roles.index', [
            'roles' => $roles
        ]);
    }

    public function create() {
        return view('admin.roles.create');
    }

    public function store(Request $request) {
        $validated = $request->validate(['name' => ['required', 'min:3']]);
        Role::create($validated);
        return to_route('admin.roles.index')->with('message', 'Role created with success');;
    }

    public function edit(int $id) {
        $role = Role::findById($id);
        $permissions = Permission::all();
        return view('admin.roles.edit', [
            'role' => $role,
            'permissions' => $permissions
        ]);
    }

    public function update(Request $request, int $id) {
        $role = Role::findById($id);
        $validated = $request->validate(['name' => ['required', 'min:3']]);
        $role->update($validated);
        return to_route('admin.roles.index')->with('message', 'Role updated with success');
    }

    public function destroy(int $id) {
        $role = Role::findById($id);
        $role->delete();
        return to_route('admin.roles.index')->with('message', 'Role removed with success');
    }

    public function assignPermission(Request $request, int $id) {
        $role = Role::findById($id);
        if($role->hasPermissionTo($request->get('permission'))) {
            return back()->with('message', 'Permission already assigned');
        }
        $role->givePermissionTo($request->get('permission'));
        return back()->with('message', 'Permission assign with success');
    }

    public function revokePermission(int $roleId, int $permissionId) {
        $role = Role::findById($roleId);
        $permission = Permission::findById($permissionId);
        $role->revokePermissionTo($permission->name);
        return back()->with('message', 'Permission revoke with success');
    }
}
