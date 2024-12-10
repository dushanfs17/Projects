<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Services') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-lg sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="flex justify-between items-center mb-4">
                        <h3 class="text-lg font-bold">Services</h3>
                        <a href="{{ route('services.create') }}" class="bg-blue-500 hover:bg-blue-600 text-white font-medium py-2 px-4 rounded-lg shadow">
                            Add New Service
                        </a>
                    </div>

                    <table class="w-full table-auto border-collapse rounded-lg overflow-hidden shadow-md">
                        <thead class="bg-gray-100">
                            <tr>
                                <th class="px-6 py-3 text-left text-sm font-semibold text-gray-600">#</th>
                                <th class="px-6 py-3 text-left text-sm font-semibold text-gray-600">Name</th>
                                <th class="px-6 py-3 text-left text-sm font-semibold text-gray-600">Description</th>
                                <th class="px-6 py-3 text-left text-sm font-semibold text-gray-600">Service Category</th>
                                <th class="px-6 py-3 text-left text-sm font-semibold text-gray-600">Service Industry</th>
                                <th class="px-6 py-3 text-center text-sm font-semibold text-gray-600">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($services as $service)
                            <tr class="even:bg-gray-50 hover:bg-gray-100 transition">
                                <td class="px-6 py-4 text-sm text-gray-800">{{ $loop->iteration }}</td>
                                <td class="px-6 py-4 text-sm text-gray-600 truncate">{{ $service->name }}</td>
                                <td class="px-6 py-4 text-sm text-gray-600 truncate">{{ Str::limit($service->description, 50, '...') }}</td>
                                <td class="px-6 py-4 text-sm text-gray-600">{{ $service->serviceCategory->name }}</td>
                                <td class="px-6 py-4 text-sm text-gray-600">{{ $service->industry->name ?? 'N/A' }}</td>
                                <td class="px-6 py-4 text-center">
                                    <div class="flex justify-center space-x-2">
                                        <a href="{{ route('services.edit', $service->id) }}" class="bg-yellow-400 hover:bg-yellow-500 text-white font-medium py-2 px-3 rounded shadow">
                                            Edit
                                        </a>
                                        <form action="{{ route('services.destroy', $service->id) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="bg-red-500 hover:bg-red-600 text-white font-medium py-2 px-3 rounded shadow">
                                                Delete
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="6" class="px-6 py-4 text-center text-gray-600">
                                    No services available.
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>