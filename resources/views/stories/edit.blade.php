<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Story') }}
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
                        <form action="{{ route('stories.update', $story->id) }}" method="POST">
                            @csrf
                            @method('PUT')

                            <div class="space-y-6">
                                <div>
                                    <label for="title" class="block text-sm font-medium text-gray-700">Judul</label>
                                    <input type="text" name="title" id="title" value="{{ old('title', $story->title) }}"
                                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring focus:ring-blue-200"
                                        required>
                                </div>

                                <div>
                                    <label for="desc" class="block text-sm font-medium text-gray-700">Deskripsi</label>
                                    <textarea name="desc" id="desc" rows="4"
                                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring focus:ring-blue-200"
                                        required>{{ old('desc', $story->desc) }}</textarea>
                                </div>

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
