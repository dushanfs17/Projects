<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Categories</title>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>

<body>
    <div class="container">
        <h1 class="text-3xl font-bold mb-6">Categories</h1>

        <!-- Add Category Form -->
        <form action="{{ route('categories.store') }}" method="POST" class="mb-8 bg-white p-6 rounded-lg shadow-md">
            @csrf
            <div class="mb-4">
                <label for="name" class="block text-sm font-medium text-gray-700">Category Name</label>
                <input type="text" name="name" id="name" placeholder="Category Name" required
                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
            </div>
            <button type="submit" class="bg-indigo-600 text-white px-4 py-2 rounded-md hover:bg-indigo-700">
                Add Category
            </button>
        </form>

        <!-- Categories List -->
        <div>
            @if ($categories->isEmpty())
            <p>No categories found.</p>
            @else
            <ul>
                @foreach ($categories as $category)
                <li>{{ $category->name }}</li>
                @endforeach
            </ul>
            @endif
        </div>
    </div>
</body>

</html>