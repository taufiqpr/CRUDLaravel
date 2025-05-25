<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Dashboard') }}
            </h2>
                @if ($histories->count())
                    <a href="{{ route('history.index') }}" class="text-sm text-blue-600 hover:underline">
                        💬 Lihat Semua Riwayat Percakapan
                    </a>
                @else
                    <p class="text-sm text-gray-500">Belum ada riwayat percakapan.</p>
                @endif

        </div>
    </x-slot>

    <div class="py-12 bg-gray-50 min-h-screen">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @if (session('success'))
                <div class="mb-4 p-4 bg-green-100 border border-green-300 text-green-700 rounded">
                    {{ session('success') }}
                </div>
            @endif

            <div class="bg-white p-6 rounded-lg shadow-md">
                <h3 class="text-xl font-semibold text-gray-800 mb-4">Selamat datang kembali 👋</h3>
                <p class="text-gray-600 leading-relaxed">
                    Kamu bisa mengelola cerita, menambahkan konten, atau melihat percakapan pengguna dari dashboard ini.
                    Gunakan tombol-tombol aksi cepat di atas untuk memulai aktivitasmu. Semangat berkarya!
                </p>
            </div>
        </div>
    </div>
</x-app-layout>
