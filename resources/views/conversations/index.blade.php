<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Conversation') }}
        </h2>
    </x-slot>

<div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">

                    <div class="flex justify-between items-center mb-4">
                        <h2 class="text-2xl font-semibold">Daftar Conversation</h2>
                        <a href="{{ route('conversations.create') }}" class="btn btn-primary mb-3">
                            + Tambah Conservation
                        </a>
                    </div>

                    @if (session('success'))
                        <div class="mb-4 text-green-600">
                            {{ session('success') }}
                        </div>
                    @endif

                    <div class="overflow-x-auto">
                        <table class="w-full table-auto border border-gray-200 shadow-md rounded-lg overflow-hidden">
                            <thead class="bg-gray-100">
                                <tr>
                                    <th class="border px-6 py-3 text-left text-sm font-medium text-gray-700">No</th>
                                    <th class="border px-6 py-3 text-left text-sm font-medium text-gray-700">Judul</th>
                                    <th class="border px-6 py-3 text-left text-sm font-medium text-gray-700">Deskripsi</th>
                                    <th class="border px-6 py-3 text-left text-sm font-medium text-gray-700">Aksi</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @forelse ($conversations as $index => $conversation)
                                    <tr>
                                        <td class="px-6 py-4">{{ $index + 1 }}</td>
                                        <td class="px-6 py-4"><a href="{{ route('conversations.show', $conversation->id) }}" class="text-blue-600 hover:underline">
                                            {{ $conversation->title }}
                                        </td>
                                        <td class="px-6 py-4">{{ $conversation->desc }}</td>                                        
                                        <td class="px-6 py-4">
                                            <a href="{{ route('conversations.edit', $conversation->id) }}" class="text-blue-600 hover:underline mr-4">Edit</a>

                                            <form action="{{ route('conversations.destroy', $conversation->id) }}" method="POST" class="inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" onclick="return confirm('Yakin ingin menghapus konten ini?')" class="text-red-600 hover:underline">Hapus</button>
                                            </form>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="6" class="px-6 py-4 text-center text-gray-500">Belum ada konten cerita.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
