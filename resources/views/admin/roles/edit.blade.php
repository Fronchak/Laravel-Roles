<x-admin-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="mb-3 text-end">
                        <a class="btn btn-success" href="{{ route('admin.roles.index') }}">Back to all roles</a>
                    </div>
                    <form method="post" action="{{ route('admin.roles.update', $role->id ) }}">
                        @csrf
                        @method("PUT")
                        <div class="mb-3">
                            <label class="form-label" for="name">Role name</label>
                            <input
                                type="text"
                                name="name"
                                id="name"
                                class="form-control"
                                placeholder="Admin"
                                value="{{ $role->name }}"
                            />
                        </div>
                        <div class="mb-3">
                            <button type="submit" class="btn btn-primary">Update</button>
                        </div>
                    </form>
                    <div class="mt-3">
                        <h2 class="fw-bold mb-3">Role's permissions</h2>
                        <div class="d-flex g-2">
                            @if($role->permissions)
                                @foreach($role->permissions as $role_permissions)
                                    <form
                                        method="POST"
                                        action="{{ route('admin.roles.permissions.revoke', [$role->id, $role_permissions->id]) }}"
                                        onsubmit="return confirm('Are you sure?');">
                                        @csrf
                                        @method("DELETE")
                                        <button class="btn btn-danger me-2">{{ $role_permissions->name }} X</button>
                                    </form>
                                @endforeach
                            @endif
                        </div>
                        <hr />
                        <div class="mt-3">
                            <form method="POST" action="{{ route('admin.roles.permissions', $role->id) }}">
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
