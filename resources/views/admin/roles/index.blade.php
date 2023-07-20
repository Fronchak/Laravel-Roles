<x-admin-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="mb-3 text-end">
                        <a class="btn btn-success" href="{{ route('admin.roles.create') }}">Create Role</a>
                    </div>
                    <table class="table align-middle">
                        <thead>
                            <tr>
                                <th scope="col">Name</th>
                                <th scope="col"></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($roles as $role)
                                <tr>
                                    <td>{{ $role->name }}</td>
                                    <td>
                                        <div class="d-flex justify-content-end">
                                            <a href="{{ route('admin.roles.edit', $role->id) }}" class="btn btn-primary me-2">Edit</a>
                                            <form method="POST" action="{{ route('admin.roles.destroy', $role->id) }}" onsubmit="return confirm('Are you sure?');">
                                                @csrf
                                                @method("DELETE")
                                                <button class="btn btn-danger me-2">Delete</button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-admin-layout>
