<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Create New Partner') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <form method="POST" action="{{ route('partners.store') }}" enctype="multipart/form-data">
                        @csrf

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <!-- Company Name -->
                            <div>
                                <label for="company_name" class="block text-sm font-medium text-gray-700">Company Name</label>
                                <input type="text" name="company_name" id="company_name" value="{{ old('company_name') }}" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" required>
                                @error('company_name')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Industry ID Dropdown -->
                            <div>
                                <label for="industry_id" class="block text-sm font-medium text-gray-700">Industry</label>
                                <select name="industry_id" id="industry_id" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" required>
                                    <option value="">Select an Industry</option>
                                    @foreach($industries as $industry)
                                    <option value="{{ $industry->id }}" {{ old('industry_id') == $industry->id ? 'selected' : '' }}>
                                        {{ $industry->name }}
                                    </option>
                                    @endforeach
                                </select>
                                @error('industry_id')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Logo -->
                            <div>
                                <label for="logo" class="block text-sm font-medium text-gray-700">Logo</label>
                                <input type="url" name="logo" id="logo" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" required>
                                @error('logo')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Collaboration Description -->
                            <div class="col-span-2">
                                <label for="collaboration_description" class="block text-sm font-medium text-gray-700">Collaboration Description</label>
                                <textarea name="collaboration_description" id="collaboration_description" rows="4" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" required>{{ old('collaboration_description') }}</textarea>
                                @error('collaboration_description')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                        </div>

                        <div class="mt-6">
                            <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                                Create Partner
                            </button>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>