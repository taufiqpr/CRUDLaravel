<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Tambah Conversation
        </h2>
    </x-slot>

    <div class="py-12 max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white shadow-sm sm:rounded-lg p-6">

            @if ($errors->any())
                <div class="mb-4 text-red-600">
                    <ul class="list-disc list-inside">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('conversations.store') }}" method="POST">
                @csrf

                <div class="space-y-6">
                    <div>
                        <label for="title" class="block font-medium text-gray-700">Judul</label>
                        <input type="text" name="title" id="title" value="{{ old('title') }}"
                            class="mt-1 block w-full rounded border border-gray-300 px-3 py-2
                                   shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                            required>
                    </div>

                    <div>
                        <label for="desc" class="block font-medium text-gray-700">Deskripsi</label>
                        <textarea name="desc" id="desc" rows="4"
                            class="mt-1 block w-full rounded border border-gray-300 px-3 py-2
                                   shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                            required>{{ old('desc') }}</textarea>
                    </div>

                </div>

                        <div class="mt-6 d-flex justify-content-end gap-2">
                            <a href="{{ route('conversations.index') }}" class="btn btn-secondary">Batal</a>
                            <button type="submit" class="btn btn-primary">Simpan</button>
                        </div>
            </form>

        </div>
    </div>
</x-app-layout>
