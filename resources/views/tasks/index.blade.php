<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tasks</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-gray-100 p-6">
    <div class="max-w-4xl mx-auto">
        <h1 class="text-3xl font-bold mb-6">Tasks</h1>

        <!-- Success/Error Messages -->
        @if (session('success'))
        <div class="mb-4 p-4 bg-green-100 text-green-700 rounded">{{ session('success') }}</div>
        @endif
        @if (session('error'))
        <div class="mb-4 p-4 bg-red-100 text-red-700 rounded">{{ session('error') }}</div>
        @endif

        <!-- Filter Form -->
        <form method="GET" action="{{ route('tasks.index') }}" class="mb-8 bg-white p-6 rounded-lg shadow-md">
            <div class="flex space-x-4">
                <div class="flex-1">
                    <label for="category_id" class="block text-sm font-medium text-gray-700">Filter by Category</label>
                    <select name="category_id" id="category_id"
                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                        <option value="">All Categories</option>
                        @foreach ($categories as $category)
                        <option value="{{ $category->id }}" {{ request('category_id') == $category->id ? 'selected' : '' }}>
                            {{ $category->name }}
                        </option>
                        @endforeach
                    </select>
                </div>
                <div class="flex-1">
                    <label for="status" class="block text-sm font-medium text-gray-700">Filter by Status</label>
                    <select name="status" id="status"
                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                        <option value="">All Statuses</option>
                        <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>Pending</option>
                        <option value="in_progress" {{ request('status') == 'in_progress' ? 'selected' : '' }}>In Progress</option>
                        <option value="completed" {{ request('status') == 'completed' ? 'selected' : '' }}>Completed</option>
                    </select>
                </div>
                <div class="flex items-end">
                    <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded-md hover:bg-blue-700">
                        Filter
                    </button>
                </div>
            </div>
        </form>

        <!-- Create Task Form -->
        <form action="{{ route('tasks.store') }}" method="POST" class="mb-8 bg-white p-6 rounded-lg shadow-md">
            @csrf
            <div class="mb-4">
                <label for="title" class="block text-sm font-medium text-gray-700">Title</label>
                <input type="text" name="title" id="title" placeholder="Task Title" required
                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                @error('title') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>
            <div class="mb-4">
                <label for="description" class="block text-sm font-medium text-gray-700">Description</label>
                <textarea name="description" id="description" rows="3" placeholder="Task Description"
                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"></textarea>
                @error('description') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>
            <div class="mb-4">
                <label for="due_date" class="block text-sm font-medium text-gray-700">Due Date</label>
                <input type="date" name="due_date" id="due_date" required
                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                @error('due_date') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>
            <div class="mb-4">
                <label for="category_id" class="block text-sm font-medium text-gray-700">Category</label>
                <select name="category_id" id="category_id" required
                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                    <option value="">Select Category</option>
                    @foreach ($categories as $category)
                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                    @endforeach
                </select>
                @error('category_id') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>
            <div class="mb-4">
                <label for="project_id" class="block text-sm font-medium text-gray-700">Project</label>
                <select name="project_id" id="project_id" required
                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                    <option value="">Select Project</option>
                    @foreach ($projects as $project)
                    <option value="{{ $project->id }}">{{ $project->name }}</option>
                    @endforeach
                </select>
                @error('project_id') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
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
                @foreach ($tasks->sortByDesc('created_at') as $task)
                <li class="border-b pb-4">
                    <h2 class="text-xl font-semibold">{{ $task->title }}</h2>
                    <p class="text-gray-600">{{ $task->description }}</p>
                    <p class="text-sm text-gray-500">Due Date: {{ $task->due_date->format('Y-m-d') }}</p>
                    <p class="text-sm text-gray-500">Category: {{ $task->category->name }}</p>
                    <p class="text-sm text-gray-500">Project: {{ $task->project->name }}</p>
                    <div class="text-sm text-gray-500">
                        <form action="{{ route('tasks.update', $task->id) }}" method="POST">
                            @csrf
                            @method('PATCH')
                            <label for="status_{{ $task->id }}">Status:</label>
                            <select name="status" id="status_{{ $task->id }}" onchange="this.form.submit()"
                                class="inline-block rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                                <option value="pending" {{ $task->status === 'pending' ? 'selected' : '' }}>Pending</option>
                                <option value="in_progress" {{ $task->status === 'in_progress' ? 'selected' : '' }}>In Progress</option>
                                <option value="completed" {{ $task->status === 'completed' ? 'selected' : '' }}>Completed</option>
                            </select>
                            <span class="float-right inline-flex items-center justify-center px-3 py-2 text-xs font-bold leading-none text-white transform bg-green-500 rounded-full {{ $task->status === 'completed' ? '' : ($task->status === 'in_progress' ? 'bg-yellow-500' : 'bg-red-500') }} flex-shrink-0">
                                {{ $task->status === 'in_progress' ? 'In Progress' : ucfirst($task->status) }}
                            </span>
                        </form>
                    </div>
                </li>
                @endforeach
            </ul>
            @endif
        </div>
    </div>
</body>

</html>