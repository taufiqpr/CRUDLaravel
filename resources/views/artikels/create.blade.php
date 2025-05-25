<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Tambah Artikel') }}
        </h2>
    </x-slot>
<div style="max-width: 600px; margin: 0 auto; padding: 20px;">
        <h1 style="margin-bottom: 20px;">Tambah Artikel</h1>

        @if ($errors->any())
            <div style="color: red; margin-bottom: 15px;">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('artikels.store') }}" method="POST">
            @csrf

            <div style="margin-bottom: 15px;">
                <label for="judul" style="display: block; font-weight: bold;">Judul:</label>
                <input type="text" name="judul" id="judul" value="{{ old('judul') }}" style="width: 100%; padding: 8px; box-sizing: border-box;">
            </div>

            <div style="margin-bottom: 15px;">
                <label for="isi" style="display: block; font-weight: bold;">Isi:</label>
                <textarea name="isi" id="isi" rows="6" style="width: 100%; padding: 8px; box-sizing: border-box;">{{ old('isi') }}</textarea>
            </div>

            <div style="display: flex; gap: 10px;">
                <button type="submit" style="padding: 8px 16px; background-color: #4CAF50; color: white; border: none; border-radius: 4px;">
                    Simpan
                </button>
                <a href="{{ route('artikels.index') }}" style="padding: 8px 16px; background-color: gray; color: white; text-decoration: none; border-radius: 4px;">
                    Kembali
                </a>
            </div>
        </form>
    </div>
    </x-app-layout>