<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Tambah Konten Percakapan
        </h2>
    </x-slot>

    <div class="py-12 max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white shadow-sm sm:rounded-lg p-6">

            {{-- Kamu bisa tambahkan keterangan / deskripsi jika perlu --}}
            <p class="text-gray-700 mb-6">
                Isi form berikut untuk menambahkan konten percakapan baru.
            </p>

            <form action="{{ route('conversation-contents.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

<p class="mb-4 text-gray-700">
    Menambahkan konten ke: <strong>{{ $conversation->title }}</strong>
</p>
<input type="hidden" name="conversations_id" value="{{ $conversation->id }}">


                <div class="mb-4">
                    <label for="speaker" class="block font-medium text-sm text-gray-700">Pembicara</label>
                    <select name="speaker" id="speaker" required
                        class="form-select mt-1 block w-full border border-gray-300 rounded-md shadow-sm
                               focus:border-indigo-500 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                        <option value="A">Speaker A</option>
                        <option value="B">Speaker B</option>
                    </select>
                </div>

                <div class="mb-4">
                    <label for="text_ksa" class="block font-medium text-sm text-gray-700">Teks Bahasa Arab</label>
                    <textarea name="text_ksa" id="text_ksa" rows="2" required
                        class="form-textarea mt-1 block w-full border border-gray-300 rounded-md shadow-sm
                               focus:border-indigo-500 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"></textarea>
                </div>

                <div class="mb-4">
                    <label for="text_idn" class="block font-medium text-sm text-gray-700">Teks Bahasa Indonesia</label>
                    <textarea name="text_idn" id="text_idn" rows="2" required
                        class="form-textarea mt-1 block w-full border border-gray-300 rounded-md shadow-sm
                               focus:border-indigo-500 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"></textarea>
                </div>

                <div class="mb-4">
                    <label for="audio" class="block font-medium text-sm text-gray-700">Upload Audio</label>
                    <input type="file" name="audio" id="audio" required accept="audio/*"
                        class="block w-full mt-1 border border-gray-300 rounded-md shadow-sm
                               focus:border-indigo-500 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" />
                                @error('audio')
        <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
    @enderror
                </div>

                <div class="mt-6 d-flex justify-content-end gap-2">
                    <a href="{{ route('conversations.show', request()->get('conversation_id') ?? '') }}" class="btn btn-secondary">Batal</a>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </form>

        </div>
    </div>
</x-app-layout>
