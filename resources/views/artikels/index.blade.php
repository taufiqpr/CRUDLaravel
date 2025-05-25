@extends('layouts.app')
@section('content')
<div style="padding: 20px;">
        <h1>Daftar Artikel</h1>

        <a href="{{ route('artikels.create') }}" style="margin-bottom: 15px; display: inline-block; background: #4CAF50; color: white; padding: 8px 12px; text-decoration: none; border-radius: 4px;">
            + Tambah Artikel
        </a>

        @if (session('success'))
            <p style="color: green">{{ session('success') }}</p>
        @endif

        <table border="1" cellpadding="10" cellspacing="0" style="width: 100%; border-collapse: collapse;">
            <thead style="background-color: #f2f2f2;">
                <tr>
                    <th>No</th>
                    <th>Judul</th>
                    <th>Isi Singkat</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($artikels as $index => $artikel)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $artikel->judul }}</td>
                        <td>{{ Str::limit($artikel->isi, 100) }}</td>
                        <td>
                            <a href="{{ route('artikels.edit', $artikel->id) }}" style="margin-right: 8px; color: blue;">Edit</a>

                            <form action="{{ route('artikels.destroy', $artikel->id) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" onclick="return confirm('Yakin ingin menghapus artikel ini?')" style="color: red;">Hapus</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4">Belum ada artikel.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    @endsection