<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Testimonial') }}
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
                    <form action="{{ route('testimonials.update', $testimonial->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="mb-4">
                            <label for="testimonial_text" class="block text-gray-700 font-bold">Testimonial Text:</label>
                            <textarea name="testimonial_text" id="testimonial_text" class="w-full border border-gray-300 rounded py-2 px-3" required>{{old('testimonial_text', $testimonial->testimonial_text) }}</textarea>
                        </div>

                        <div class="mb-4">
                            <label for="client_name" class="block text-gray-700 font-bold">Clien Name:</label>
                            <input type="text" name="client_name" id="client_name" value="{{old('client_name', $testimonial->client_name) }}" class="w-full border border-gray-300 rounded py-2 px-3" required>
                        </div>

                        <div class="mb-4">
                            <label for="client_position" class="block text-gray-700 font-bold">Clien Position:</label>
                            <input type="text" name="client_position" id="client_position" value="{{old('client_position', $testimonial->client_position) }}" class="w-full border border-gray-300 rounded py-2 px-3" required>
                        </div>

                        <div class="mb-4">
                            <label for="client_company" class="block text-gray-700 font-bold">Clien Company:</label>
                            <input type="text" name="client_company" id="client_name" value="{{old('client_company', $testimonial->client_company) }}" class="w-full border border-gray-300 rounded py-2 px-3" required>
                        </div>

                        <class="mb-4">
                            <label for="client_profile_picture" class="block text-gray-700 font-bold">Clien Profile Picture:</label>
                            <input type="url" name="client_profile_picture" id="client_profile_picture" value="{{ $testimonial->client_profile_picture }}" class="w-full border border-gray-300 rounded py-2 px-3" required>
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
