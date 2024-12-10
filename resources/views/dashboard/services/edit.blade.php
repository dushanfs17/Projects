<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Services') }}
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
                    <form action="{{ route('services.update', $service->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="mb-4">
                            <label for="name" class="block text-gray-700 font-bold">Name:</label>
                            <input type="text" name="name" id="name" value="{{old('name', $service->name) }}" class="w-full border border-gray-300 rounded py-2 px-3" required>
                        </div>

                        <div class="mb-4">
                            <label for="description" class="block text-gray-700 font-bold">Description:</label>
                            <textarea name="description" id="description" class="w-full border border-gray-300 rounded py-2 px-3">{{ $service->description }}</textarea>
                        </div>


                        <div>
                                <label for="service_category_id" class="block text-sm font-medium text-gray-700">Service Service Category</label>
                                <select name="service_category_id" id="service_category_id" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" required>
                                    <label>Select an Service Category</label>
                                    @foreach($serviceCategories as $serviceCategory)
                                    <option value="{{ $serviceCategory->id }}" {{ old('service_category_id') == $serviceCategory->id ? 'selected' : '' }}>
                                        {{ $serviceCategory->name }}
                                    </option>
                                    @endforeach
                                </select>
                                @error('service_category_id')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                @enderror
                            </div>


                        <div>
                                <label for="industry_id" class="block text-sm font-medium text-gray-700">Service Industry</label>
                                <select name="industry_id" id="industry_id" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" required>
                                    <label>Select an Industry</label>
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



                        

                        <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                            Update
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
