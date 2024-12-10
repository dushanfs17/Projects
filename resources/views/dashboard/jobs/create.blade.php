<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Create Job') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <form action="{{ route('jobs.store') }}" method="POST">
                        @csrf

                        <div class="mb-4">
                            <label for="title" class="block text-gray-700 font-bold">Title:</label>
                            <input type="text" name="title" id="title" class="w-full border border-gray-300 rounded py-2 px-3" required>
                        </div>

                        <div class="mb-4">
                            <label for="description" class="block text-gray-700 font-bold">Description:</label>
                            <textarea name="description" id="description" class="w-full border border-gray-300 rounded py-2 px-3" maxlength="900" required></textarea>
                        </div>

                        <div class="mb-4">
                            <label for="type" class="block text-gray-700 font-bold">Type:</label>
                            <select name="type" id="type" class="w-full border border-gray-300 rounded py-2 px-3" required>
                                <option value="full-time">Full-Time</option>
                                <option value="part-time">Part-Time</option>
                            </select>
                        </div>

                        <div class="mb-4">
                            <label for="work_mode" class="block text-gray-700 font-bold">Work Mode:</label>
                            <select name="work_mode" id="work_mode" class="w-full border border-gray-300 rounded py-2 px-3" required>
                                <option value="hybrid">Hybrid</option>
                                <option value="on-site">On-Site</option>
                            </select>
                        </div>

                        <div class="mb-4">
                            <label for="location" class="block text-gray-700 font-bold">Location:</label>
                            <input type="text" name="location" id="location" class="w-full border border-gray-300 rounded py-2 px-3" required>
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
