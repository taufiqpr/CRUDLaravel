<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Edit Konten Percakapan
        </h2>
    </x-slot>

    <div class="py-12 max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white shadow-sm sm:rounded-lg p-6">

            @if ($errors->any())
                <div class="mb-6 text-red-600">
                    <ul class="list-disc list-inside">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('conversation-contents.update', $content->id) }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                @csrf
                @method('PUT')

                <div>
                    <label for="speaker" class="block text-gray-700 font-semibold mb-2">Pembicara</label>
                    <select name="speaker" id="speaker" required
                        class="w-full border border-gray-300 rounded px-3 py-2 shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500">
                        <option value="A" {{ $content->speaker === 'A' ? 'selected' : '' }}>Speaker A</option>
                        <option value="B" {{ $content->speaker === 'B' ? 'selected' : '' }}>Speaker B</option>
                    </select>
                </div>

                <div>
                    <label for="text_ksa" class="block text-gray-700 font-semibold mb-2">Teks Bahasa KSA</label>
                    <textarea name="text_ksa" id="text_ksa" rows="3" required
                        class="w-full border border-gray-300 rounded px-3 py-2 shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500">{{ $content->text_ksa }}</textarea>
                </div>

                <div>
                    <label for="text_idn" class="block text-gray-700 font-semibold mb-2">Teks Bahasa Indonesia</label>
                    <textarea name="text_idn" id="text_idn" rows="3" required
                        class="w-full border border-gray-300 rounded px-3 py-2 shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500">{{ $content->text_idn }}</textarea>
                </div>

                <div>
                    <label class="block text-gray-700 font-semibold mb-2">Audio Saat Ini:</label>
                    @if($content->audio)
                        <audio controls class="mb-4 w-full max-w-md">
                            <source src="{{ asset('storage/' . $content->audio) }}" type="audio/mpeg">
                            Your browser does not support the audio element.
                        </audio>
                    @else
                        <p class="text-gray-500 mb-4">Tidak ada audio.</p>
                    @endif

                    <label for="audio" class="block text-gray-700 font-semibold mb-2">Ganti Audio (opsional)</label>
                    <input type="file" name="audio" id="audio" accept="audio/*"
                        class="w-full border border-gray-300 rounded px-3 py-2 shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500">
                </div>

                        <div class="mt-6 d-flex justify-content-end gap-2">
                            <a href="{{ route('conversations.index') }}" class="btn btn-secondary">Batal</a>
                            <button type="submit" class="btn btn-primary">Simpan</button>
                        </div>
            </form>

        </div>
    </div>
</x-app-layout>
