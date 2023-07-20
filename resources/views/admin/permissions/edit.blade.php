<x-admin-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="mb-3 text-end">
                        <a class="btn btn-success" href="{{ route('admin.permissions.index') }}">Back to all permissions</a>
                    </div>
                    <form method="post" action="{{ route('admin.permissions.update', $permission->id) }}">
                        @csrf
                        @method("PUT")
                        <div class="mb-3">
                            <label class="form-label" for="name">Permissions name</label>
                            <input
                                type="text"
                                name="name"
                                id="name"
                                class="form-control"
                                placeholder="Edit post"
                                value="{{ $permission->name }}"
                            />
                        </div>
                        <div class="mb-3">
                            <button type="submit" class="btn btn-primary">Update</button>
                        </div>
                    </form>
                    <div class="mt-3">
                        <h2 class="fw-bold mb-3">Permission's roles</h2>
                        <div class="d-flex g-2">
                            @if($permission->roles)
                                @foreach($permission->roles as $permission_role)
                                    <form
                                        method="POST"
                                        action="{{ route('admin.permissions.roles.remove', [$permission->id, $permission_role->id]) }}"
                                        onsubmit="return confirm('Are you sure?');">
                                        @csrf
                                        @method("DELETE")
                                        <button class="btn btn-danger me-2">{{ $permission_role->name }} X</button>
                                    </form>
                                @endforeach
                            @endif
                        </div>
                        <hr />
                        <div class="mt-3">
                            <form method="POST" action="{{ route('admin.permissions.roles', $permission->id) }}">
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
                </div>
            </div>
        </div>
    </div>
</x-admin-layout>
