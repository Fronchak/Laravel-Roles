<x-admin-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="mb-3 text-end">
                        <a class="btn btn-success" href="{{ route('admin.roles.index') }}">Back to all roles</a>
                    </div>
                    <form method="post" action="{{ route('admin.roles.store') }}">
                        @csrf
                        <div class="mb-3">
                            <label class="form-label" for="name">Role name</label>
                            <input
                                type="text"
                                name="name"
                                id="name"
                                class="form-control"
                                placeholder="Admin"
                            />
                        </div>
                        <div class="mb-3">
                            <button type="submit" class="btn btn-primary">Create</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-admin-layout>
