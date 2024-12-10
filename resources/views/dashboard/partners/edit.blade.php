<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit partner') }}
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
                    <form action="{{ route('partners.update', $partner->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="mb-4">
                            <label for="company_name" class="block text-gray-700 font-bold">Company Name:</label>
                            <input type="text" name="company_name" id="company_name" value="{{ $partner->company_name }}" class="w-full border border-gray-300 rounded py-2 px-3" required>
                        </div>

                         <div>
                                <label for="industry_id" class="block text-sm font-medium text-gray-700">Industry</label>
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

                        <div class="mb-4">
                            <label for="logo" class="block text-gray-700 font-bold">Logo:</label>
                            <input type="text" name="logo" id="logo" value="{{ $partner->logo }}" class="w-full border border-gray-300 rounded py-2 px-3" required>
                        </div>

                        <div class="mb-4">
                            <label for="collaboration_description" class="block text-gray-700 font-bold">Colaboration Description:</label>
                            <textarea name="collaboration_description" id="collaboration_description" class="w-full border border-gray-300 rounded py-2 px-3">{{ $partner->collaboration_description }}</textarea>
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
