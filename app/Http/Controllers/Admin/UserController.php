<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{
    public function index() {
        $users = User::all();
        return view('admin.users.index', [
            'users' => $users
        ]);
    }

    public function destroy(int $id) {

        return back()->with('message', 'User deleted with success');
    }

    public function edit(int $id) {
        $user = User::find($id);
        $roles = Role::all();
        $permissions = Permission::all();
        return view('admin.users.edit', [
            'user' => $user,
            'roles' => $roles,
            'permissions' => $permissions
        ]);
    }

    public function assignRole(Request $request, int $id) {
        $user = User::find($id);
        if($user->hasRole($request->get('role'))) {
            return back()->with('message', 'Role already assigned');
        }
        $user->assignRole($request->get('role'));
        return back()->with('message', 'Role assigned with success');
    }

    public function removeRole(int $userId, int $roleId) {
        $user = User::find($userId);
        $role = Role::findById($roleId);
        $user->removeRole($role->name);
        return back()->with('message', 'Role remove with success');
    }

    public function assignPermission(Request $request, int $id) {
        $user = User::find($id);
        if($user->hasPermissionTo($request->get('permission'))) {
            return back()->with('message', 'Permission already assigned');
        }
        $user->givePermissionTo($request->get('permission'));
        return back()->with('message', 'Permission assigned with success');
    }

    public function revokePermission(int $userId, int $permissionId) {
        $user = User::find($userId);
        $permission = Permission::findById($permissionId);
        $user->revokePermissionTo($permission->name);
        return back()->with('message', 'Permission revoke with success');
    }
}
