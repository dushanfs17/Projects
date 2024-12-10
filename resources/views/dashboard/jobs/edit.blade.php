<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Job') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <form action="{{ route('jobs.update', $job->id) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="mb-4">
                            <label for="title" class="block text-gray-700 font-bold">Title:</label>
                            <input type="text" name="title" id="title" value="{{ $job->title }}" class="w-full border border-gray-300 rounded py-2 px-3" required>
                        </div>

                        <div class="mb-4">
                            <label for="description" class="block text-gray-700 font-bold">Description:</label>
                            <textarea name="description" id="description" class="w-full border border-gray-300 rounded py-2 px-3" maxlength="900" required>{{ $job->description }}</textarea>
                        </div>

                        <div class="mb-4">
                            <label for="type" class="block text-gray-700 font-bold">Type:</label>
                            <select name="type" id="type" class="w-full border border-gray-300 rounded py-2 px-3" required>
                                <option value="full-time" {{ $job->type == 'full-time' ? 'selected' : '' }}>Full-Time</option>
                                <option value="part-time" {{ $job->type == 'part-time' ? 'selected' : '' }}>Part-Time</option>
                            </select>
                        </div>

                        <div class="mb-4">
                            <label for="work_mode" class="block text-gray-700 font-bold">Work Mode:</label>
                            <select name="work_mode" id="work_mode" class="w-full border border-gray-300 rounded py-2 px-3" required>
                                <option value="hybrid" {{ $job->work_mode == 'hybrid' ? 'selected' : '' }}>Hybrid</option>
                                <option value="on-site" {{ $job->work_mode == 'on-site' ? 'selected' : '' }}>On-Site</option>
                            </select>
                        </div>

                        <div class="mb-4">
                            <label for="location" class="block text-gray-700 font-bold">Location:</label>
                            <input type="text" name="location" id="location" value="{{ $job->location }}" class="w-full border border-gray-300 rounded py-2 px-3" required>
                        </div>

                        <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                            Update
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
