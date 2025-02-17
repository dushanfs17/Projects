<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Projects</title>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>

<body class="bg-gray-100 p-6">
    <div class="max-w-4xl mx-auto">
        <h1 class="text-3xl font-bold mb-6">Projects</h1>

        <!-- Create Project Form -->
        <form action="{{ route('projects.store') }}" method="POST" class="mb-8 bg-white p-6 rounded-lg shadow-md">
            @csrf
            <div class="mb-4">
                <label for="name" class="block text-sm font-medium text-gray-700">Name</label>
                <input type="text" name="name" id="name" placeholder="Project Name" required
                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
            </div>
            <div class="mb-4">
                <label for="description" class="block text-sm font-medium text-gray-700">Description</label>
                <textarea name="description" id="description" rows="3" placeholder="Project Description"
                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"></textarea>
            </div>
            <div class="mb-4">
                <label for="due_date" class="block text-sm font-medium text-gray-700">Due Date</label>
                <input type="date" name="due_date" id="due_date" required
                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
            </div>
            <button type="submit" class="bg-indigo-600 text-white px-4 py-2 rounded-md hover:bg-indigo-700">
                Create Project
            </button>
        </form>

        <!-- Filter -->
        <form action="{{ route('projects.index') }}" method="GET" class="mb-6">
            <label for="due_date_filter" class="block text-sm font-medium text-gray-700">Filter by Due Date</label>
            <input type="date" name="due_date" id="due_date_filter" onchange="this.form.submit()"
                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
        </form>

        <!-- Projects List -->
        <div class="bg-white p-6 rounded-lg shadow-md">
            @if ($projects->isEmpty())
            <p class="text-gray-600">No projects found.</p>
            @else
            <ul class="space-y-4">
                @foreach ($projects as $project)
                <li class="border-b pb-4">
                    <h2 class="text-xl font-semibold">{{ $project->name }}</h2>
                    <p class="text-gray-600">{{ $project->description }}</p>
                    <p class="text-sm text-gray-500">Due Date: {{ $project->due_date->format('Y-m-d') }}</p>
                </li>
                @endforeach
            </ul>
            @endif
        </div>
    </div>
</body>

</html>