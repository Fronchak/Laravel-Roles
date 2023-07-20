<x-admin-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="mb-3 text-end">
                        <a class="btn btn-success" href="{{ route('admin.users.index') }}">Back to all users</a>
                    </div>
                    <div>
                        <h2>{{ $user->name }}</h2>
                    </div>
                    <div class="mt-3">
                        <h2 class="fw-bold mb-3">Roles</h2>
                        <div class="d-flex g-2">
                            @if($user->roles)
                                @foreach($user->roles as $user_role)
                                    <form
                                        method="POST"
                                        action="{{ route('admin.users.roles.remove', [$user->id, $user_role->id]) }}"
                                        onsubmit="return confirm('Are you sure?');">
                                        @csrf
                                        @method("DELETE")
                                        <button class="btn btn-danger me-2">{{ $user_role->name }} X</button>
                                    </form>
                                @endforeach
                            @endif
                        </div>
                        <hr />
                        <div class="mt-3">
                            <form method="POST" action="{{ route('admin.users.roles', $user->id) }}">
                                @csrf
                                <div class="mb-3">
                                    <label class="form-label" for="role">Roles</label>
                                    <select
                                        id="role"
                                        name="role"
                                        class="form-select">
                                        @foreach($roles as $role)
                                            <option value="{{ $role->name }}">{{ $role->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <button type="submit" class="btn btn-primary">Assign role</button>
                                </div>
                            </form>
                        </div>
                        <h2 class="fw-bold mb-3">Permissions</h2>
                        <div class="d-flex g-2">
                            @if($user->permissions)
                                @foreach($user->permissions as $user_permission)
                                    <form
                                        method="POST"
                                        action="{{ route('admin.users.permissions.revoke', [$user->id, $user_permission->id]) }}"
                                        onsubmit="return confirm('Are you sure?');">
                                        @csrf
                                        @method("DELETE")
                                        <button class="btn btn-danger me-2">{{ $user_permission->name }} X</button>
                                    </form>
                                @endforeach
                            @endif
                        </div>
                        <div class="mt-3">
                            <form method="POST" action="{{ route('admin.users.permissions', $user->id) }}">
                                @csrf
                                <div class="mb-3">
                                    <label class="form-label" for="permission">Permissions</label>
                                    <select
                                        id="permission"
                                        name="permission"
                                        class="form-select">
                                        @foreach($permissions as $permission)
                                            <option value="{{ $permission->name }}">{{ $permission->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <button type="submit" class="btn btn-primary">Assign permission</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-admin-layout>
