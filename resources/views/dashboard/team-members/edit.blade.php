<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Team Member') }}
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
                    <form action="{{ route('team-members.update', $teamMember->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="mb-4">
                            <label for="picture" class="block text-gray-700 font-bold">Picture:</label>
                            <input type="url" name="picture" id="picture" value="{{old('picture' , $teamMember->picture) }}" class="w-full border border-gray-300 rounded py-2 px-3" required>
                        </div>
                        <div class="mb-4">
                            <label for="name" class="block text-gray-700 font-bold">Name:</label>
                            <input type="text" name="name" id="name" value="{{old('name' , $teamMember->name) }}" class="w-full border border-gray-300 rounded py-2 px-3" required>
                        </div>
                        <div class="mb-4">
                            <label for="surname" class="block text-gray-700 font-bold">Surname:</label>
                            <input type="text" name="surname" id="surname" value="{{old('surname' , $teamMember->surname) }}" class="w-full border border-gray-300 rounded py-2 px-3" required>
                        </div>
                       <select name="position_id" id="position_id" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" required>
                                    <label>Select an Position</label>
                                    @foreach($positions as $position)
                                    <option value="{{ $position->id }}" {{ old('position_id' , $teamMember->position_id) == $position->id ? 'selected' : '' }}>
                                        {{ $position->name }}
                                    </option>
                                    @endforeach
                        </select>

                        <div class="mb-4">
                            <label for="short_profile" class="block text-gray-700 font-bold">Short Profile:</label>
                            <textarea name="short_profile" id="short_profile" class="w-full border border-gray-300 rounded py-2 px-3">{{old('short_profile', $teamMember->short_profile) }}</textarea>
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

