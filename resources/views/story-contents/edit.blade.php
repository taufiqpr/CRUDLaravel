<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Konten Cerita') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">

                    @if ($errors->any())
                        <div class="mb-4 text-red-600">
                            <ul class="list-disc list-inside">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <div class="max-w-lg mx-auto">
                        <form action="{{ route('story-contents.update', $story->id) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')

                            <div class="space-y-6">

                                <!-- Text KSA -->
                                <div>
                                    <label for="text_ksa" class="block text-sm font-medium text-gray-700">Text KSA</label>
                                    <textarea id="text_ksa" name="text_ksa" rows="3"
                                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring focus:ring-blue-200"
                                        required>{{ old('text_ksa', $story->text_ksa) }}</textarea>
                                </div>

                                <!-- Text IDN -->
                                <div>
                                    <label for="text_idn" class="block text-sm font-medium text-gray-700">Text IDN</label>
                                    <textarea id="text_idn" name="text_idn" rows="3"
                                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring focus:ring-blue-200"
                                        required>{{ old('text_idn', $story->text_idn) }}</textarea>
                                </div>

                                <!-- Audio Upload -->
                                <div>
                                    <label for="audio" class="block text-sm font-medium text-gray-700">Audio</label>
                                    <input type="file" id="audio" name="audio" accept="audio/*"
                                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring focus:ring-blue-200">
                                    
                                    @if ($story->audio)
                                        <p class="mt-2 text-sm text-gray-600">Audio saat ini:</p>
                                        <audio controls class="mt-1 w-full max-w-md">
                                            <source src="{{ asset('storage/' . $story->audio) }}" type="audio/mpeg">
                                            Your browser does not support the audio element.
                                        </audio>
                                    @endif
                                </div>

                                <!-- Story Group -->

                            </div>

                            <div class="mt-6 flex justify-end gap-2">
                                <a href="{{ route('stories.index') }}" class="btn btn-secondary">Batal</a>
                                <button type="submit" class="btn btn-primary">Simpan</button>
                            </div>

                        </form>
                    </div>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
