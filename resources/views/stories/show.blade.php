<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ $story->title }}
        </h2>
    </x-slot>

    <div class="py-12 max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white p-6 shadow-sm rounded-lg">

            <!-- Tombol tambah konten -->
            <a href="{{ route('story-contents.create', $story->id) }}" 
            class="btn btn-primary mb-6 inline-block px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">
                + Tambah Konten Cerita
            </a>

            <p class="mb-6 text-gray-700">{{ $story->desc }}</p>

            <h3 class="text-lg font-semibold mb-4 border-b pb-2">Konten Cerita:</h3>

            @forelse ($story->contents as $content)
                <div class="mb-8 p-4 border rounded shadow-sm">
                    <p><strong>Text KSA:</strong> {{ $content->text_ksa }}</p>
                    <p><strong>Text IDN:</strong> {{ $content->text_idn }}</p>
                    <p><strong>Audio:</strong></p>
                    <audio controls class="mb-3 w-full max-w-md">
                        <source src="{{ asset('storage/' . $content->audio) }}" type="audio/mpeg">
                        Your browser does not support the audio element.
                    </audio>

                    <div class="mt-4 flex gap-3">
                        <a href="{{ route('story-contents.edit', $content->id) }}" 
                           class="btn btn-secondary text-sm px-4 py-2 border rounded hover:bg-gray-100">
                            Edit
                        </a>

                        <form action="{{ route('story-contents.destroy', $content->id) }}" method="POST"
                              onsubmit="return confirm('Yakin ingin menghapus konten ini?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" 
                                    class="btn btn-danger text-sm px-4 py-2 rounded bg-red-600 text-white hover:bg-red-700">
                                Delete
                            </button>
                        </form>
                    </div>
                </div>
            @empty
                <p class="text-gray-500">Belum ada konten untuk cerita ini.</p>
            @endforelse

            <a href="{{ route('stories.index') }}" class="text-blue-600 hover:underline mt-6 inline-block">
                &larr; Kembali ke Daftar Cerita
            </a>

        </div>
    </div>
</x-app-layout>
