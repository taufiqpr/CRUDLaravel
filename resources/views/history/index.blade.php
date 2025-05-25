<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Riwayat Percakapan') }}
        </h2>
    </x-slot>

    <div class="py-12 bg-gray-50 min-h-screen">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white p-6 rounded-lg shadow-md">
                @if ($histories->count())
                    <div class="space-y-6">
                        @foreach ($histories as $history)
                            <div class="border border-gray-200 p-4 rounded shadow-sm bg-gray-100">
                                <h3 class="font-semibold text-gray-700 mb-2">
                                    💬 Percakapan #{{ $loop->iteration }} — {{ $history->created_at->format('d M Y, H:i') }}
                                </h3>

                                <p class="text-gray-800 mb-1"><strong>Story ID:</strong> {{ $history->story_id }}</p>
                                <p class="text-gray-800 mb-1"><strong>Kemiripan:</strong> {{ $history->similarity_percentage }}%</p>

                                @if ($history->audio && $history->audio !== '-')
                                    <audio controls class="mt-2">
                                        <source src="{{ asset('storage/audio/' . $history->audio) }}" type="audio/mpeg">
                                        Browsermu tidak mendukung audio.
                                    </audio>
                                @else
                                    <p class="text-gray-500 italic">Tidak ada audio</p>
                                @endif

                                {{-- Kalau ingin tampilkan cerita/story detail: --}}
                                @if ($history->story)
                                    <div class="mt-3 bg-white border rounded p-3 shadow-inner">
                                        <h4 class="font-semibold text-sm text-gray-700">Cerita:</h4>
                                        <p class="text-gray-600 whitespace-pre-line">{{ $history->story->content ?? '-' }}</p>
                                    </div>
                                @endif
                            </div>
                        @endforeach
                    </div>
                @else
                    <p class="text-gray-500">Belum ada riwayat percakapan.</p>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>
