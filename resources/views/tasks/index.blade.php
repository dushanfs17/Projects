<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tasks</title>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>

<body class="bg-gray-100 p-6">
    <div class="max-w-4xl mx-auto">
        <h1 class="text-3xl font-bold mb-6">Tasks</h1>

        <!-- Create Task Form -->
        <form action="{{ route('tasks.store') }}" method="POST" class="mb-8 bg-white p-6 rounded-lg shadow-md">
            @csrf
            <div class="mb-4">
                <label for="title" class="block text-sm font-medium text-gray-700">Title</label>
                <input type="text" name="title" id="title" placeholder="Task Title" required
                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
            </div>
            <div class="mb-4">
                <label for="description" class="block text-sm font-medium text-gray-700">Description</label>
                <textarea name="description" id="description" rows="3" placeholder="Task Description"
                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"></textarea>
            </div>
            <div class="mb-4">
                <label for="due_date" class="block text-sm font-medium text-gray-700">Due Date</label>
                <input type="date" name="due_date" id="due_date" required
                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
            </div>
            <div class="mb-4">
                <label for="category_id" class="block text-sm font-medium text-gray-700">Category</label>
                <select name="category_id" id="category_id" required
                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                    <option value="">Select Category</option>
                    @foreach($categories as $category)
                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="mb-4">
                <label for="project_id" class="block text-sm font-medium text-gray-700">Project</label>
                <select name="project_id" id="project_id" required
                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                    <option value="">Select Project</option>
                    @foreach($projects as $project)
                    <option value="{{ $project->id }}">{{ $project->name }}</option>
                    @endforeach
                </select>
            </div>
            <button type="submit" class="bg-indigo-600 text-white px-4 py-2 rounded-md hover:bg-indigo-700">
                Create Task
            </button>
        </form>

        <!-- Tasks List -->
        <div class="bg-white p-6 rounded-lg shadow-md">
            @if ($tasks->isEmpty())
            <p class="text-gray-600">No tasks found.</p>
            @else
            <ul class="space-y-4">
                @foreach ($tasks as $task)
                <li class="border-b pb-4">
                    <h2 class="text-xl font-semibold">{{ $task->title }}</h2>
                    <p class="text-gray-600">{{ $task->description }}</p>
                    <p class="text-sm text-gray-500">Due Date: {{ $task->due_date->format('Y-m-d') }}</p>
                    <p class="text-sm text-gray-500">Category: {{ $task->category->name }}</p>
                    <p class="text-sm text-gray-500">Project: {{ $task->project->name }}</p>
                    <p class="text-sm text-gray-500">Status: <span class="{{ $task->status === 'completed' ? 'text-green-500' : ($task->status === 'in_progress' ? 'text-yellow-500' : 'text-red-500') }}">{{ ucfirst($task->status) }}</span></p>
                </li>
                @endforeach
            </ul>
            @endif
        </div>
    </div>
</body>

</html>