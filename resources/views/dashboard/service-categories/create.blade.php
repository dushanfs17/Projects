<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Create Service Category') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <form action="{{ route('service-categories.store') }}" method="POST">
                        @csrf
                        <div class="mb-4">
                            <label for="name" class="block text-gray-700 font-bold">Name:</label>
                            <input type="text" name="name" id="name" class="w-full border border-gray-300 rounded py-2 px-3" required>
                        </div>

                        <div class="mb-4">
                            <label for="description" class="block text-gray-700 font-bold">Description:</label>
                            <textarea name="description" id="description" class="w-full border border-gray-300 rounded py-2 px-3"></textarea>
                        </div>

                        <button type="submit" class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">
                            Save
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
