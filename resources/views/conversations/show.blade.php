<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ $conversation->title }}
        </h2>
    </x-slot>

    <div class="py-12 max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white shadow-sm sm:rounded-lg p-6">

            <!-- Tombol tambah konten -->
            <a href="{{ route('conversation-contents.create', ['conversation_id' => $conversation->id]) }}" 
               class="btn btn-primary mb-6 inline-block px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">
                + Tambah Konten
            </a>

            <p class="text-gray-700 mb-6">{{ $conversation->desc }}</p>

            <h3 class="font-semibold text-lg mb-4 border-b pb-2">Isi Percakapan:</h3>

            @if($conversation->contents->count())
                <ul class="space-y-6">
                    @foreach($conversation->contents as $content)
                        <li class="border rounded p-4 shadow-sm">
                            <div>
                                <strong class="text-indigo-700">Pembicara:</strong> {{ $content->speaker }}<br>
                                <strong class="text-indigo-700">Bahasa KSA:</strong> {{ $content->text_ksa }}<br>
                                <strong class="text-indigo-700">Bahasa Indonesia:</strong> {{ $content->text_idn }}<br>
                                @if($content->audio)
                                    <audio controls class="mt-2 w-full max-w-md">
                                        <source src="{{ asset('storage/' . $content->audio) }}" type="audio/mpeg">
                                        Your browser does not support the audio element.
                                    </audio>
                                @endif
                            </div>

                            <div class="mt-4 flex gap-3">
                                <a href="{{ route('conversation-contents.edit', $content->id) }}" 
                                   class="btn btn-secondary text-sm px-4 py-2 border rounded hover:bg-gray-100">
                                    Edit
                                </a>
                                <form action="{{ route('conversation-contents.destroy', $content->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus konten ini?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger text-sm px-4 py-2 rounded bg-red-600 text-white hover:bg-red-700">
                                        Hapus
                                    </button>
                                </form>
                            </div>
                        </li>
                    @endforeach
                </ul>
            @else
                <p class="text-gray-500">Belum ada isi percakapan.</p>
            @endif

            <a href="{{ route('conversations.index') }}" class="text-blue-600 hover:underline mt-6 inline-block">
                ← Kembali ke daftar conversation
            </a>
        </div>
    </div>
</x-app-layout>
