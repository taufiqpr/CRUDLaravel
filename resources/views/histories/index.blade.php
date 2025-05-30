<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Riwayat') }}
        </h2>
    </x-slot>

    <div class="py-12 max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white shadow-sm sm:rounded-lg p-6">

            <h3 class="font-semibold text-lg mb-4 border-b pb-2">Riwayat Percakapan:</h3>

            @if ($histories->count())
                <ul class="space-y-6">
                    @foreach ($histories as $history)
                        <li class="border rounded p-4 shadow-sm">
                            <div>
                                <strong class="text-indigo-700">Waktu:</strong>
                                {{ $history->created_at->setTimezone('Asia/Jakarta')->format('d M Y, H:i') }}<br>

                                <strong class="text-indigo-700">Nama Pengguna:</strong>
                                {{ $history->user->name ?? '-' }}<br>

                                <strong class="text-indigo-700">Similarity:</strong>
                                {{ $history->similarity_percentage }}%<br>

                                @if ($history->audio && $history->audio !== '-')
                                    <audio controls class="mt-2 w-full max-w-md">
                                        <source src="{{ asset('storage/audio/' . $history->audio) }}" type="audio/mpeg">
                                        Browsermu tidak mendukung audio.
                                    </audio>
                                @else
                                    <p class="text-gray-500 italic">Tidak ada audio</p>
                                @endif
                            </div>

                            @if ($history->story)
                                <div class="mt-4 bg-white border rounded p-3 shadow-inner">
                                    <strong class="text-indigo-700">Judul Cerita:</strong><br>
                                    <p class="text-gray-900 font-medium mb-2">{{ $history->story->title ?? '-' }}</p>

                                    <strong class="text-indigo-700">Isi Cerita:</strong><br>
                                    <p class="text-gray-600 whitespace-pre-line">{{ $history->story->desc ?? '-' }}</p>
                                </div>
                            @endif

                            <div class="mt-4 flex gap-3">
                                <form action="{{ route('histories.destroy', $history->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus riwayat ini?');">
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
                <p class="text-gray-500">Belum ada riwayat percakapan.</p>
            @endif

            <a href="{{ route('dashboard') }}" class="text-blue-600 hover:underline mt-6 inline-block">
                ← Kembali ke Dashboard
            </a>
        </div>
    </div>
</x-app-layout>
