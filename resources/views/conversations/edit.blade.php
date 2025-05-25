<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Conversation') }}
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

            <form action="{{ route('conversations.update', $conversation->id) }}" method="POST" class="space-y-6">
                @csrf
                @method('PUT')

                <div>
                    <label for="title" class="block text-gray-700 font-semibold mb-2">Judul</label>
                    <input type="text" name="title" id="title" required
                        class="w-full border border-gray-300 rounded px-3 py-2 shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500"
                        value="{{ old('title', $conversation->title) }}">
                </div>

                <div>
                    <label for="desc" class="block text-gray-700 font-semibold mb-2">Deskripsi</label>
                    <textarea name="desc" id="desc" rows="4" required
                        class="w-full border border-gray-300 rounded px-3 py-2 shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500">{{ old('desc', $conversation->desc) }}</textarea>
                </div>

                        <div class="mt-6 d-flex justify-content-end gap-2">
                            <a href="{{ route('conversations.index') }}" class="btn btn-secondary">Batal</a>
                            <button type="submit" class="btn btn-primary">Simpan</button>
                        </div>
            </form>

        </div>
    </div>
</x-app-layout>
