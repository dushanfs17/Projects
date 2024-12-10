<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Industry') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    @if ($errors->any())
                        <div class="bg-red-500 text-white p-4 rounded-md mb-4">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    <form action="{{ route('industries.update', $industry->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="mb-4">
                            <label for="name" class="block text-gray-700 font-bold">Name:</label>
                            <input type="text" name="name" id="name" value="{{ $industry->name }}" class="w-full border border-gray-300 rounded py-2 px-3" required>
                        </div>

                        <div class="mb-4">
                            <label for="description" class="block text-gray-700 font-bold">Description:</label>
                            <textarea name="description" id="description" class="w-full border border-gray-300 rounded py-2 px-3">{{ $industry->description }}</textarea>
                        </div>

                        <div class="mb-4">
                            <label for="icon" class="block text-gray-700 font-bold">Icon:</label>
                            <input type="text" name="icon" id="icon" value="{{ $industry->icon }}" class="w-full border border-gray-300 rounded py-2 px-3" required>
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
