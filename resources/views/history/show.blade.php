<x-app-layout>
<x-slot name="header">
    <div class="flex justify-between items-center">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Story') }}
        </h2>
    </div>
</x-slot>

<div class="container">
    <h2>Riwayat Bacaan</h2>

    <p><strong>User:</strong> {{ $history->user->name }}</p>
    <p><strong>Judul Cerita:</strong> {{ $history->story->text_idn ?? '-' }}</p>
    <p><strong>Similarity:</strong> {{ $history->similarity_percentage }}%</p>
    <p><strong>Audio:</strong></p>
    <audio controls>
        <source src="{{ asset('storage/' . $history->audio) }}" type="audio/mpeg">
        Browser kamu tidak mendukung audio.
    </audio>
</div>
</x-app-layout>
