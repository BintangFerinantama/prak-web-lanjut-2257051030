@extends('layouts.app')

@section('content')
<div class="container mx-auto p-6">
    <h1 class="text-3xl font-semibold text-blue-700 mb-6">Detail Pengguna</h1>

    <div class="max-w-md mx-auto bg-white shadow-lg rounded-xl p-6">
        <div class="flex flex-col items-center space-y-4">
            <!-- Tampilkan Foto Pengguna -->
            @if ($user->foto)
                <img src="{{ asset('upload/img/' . basename($user->foto)) }}" alt="Foto Pengguna" class="h-32 w-32 rounded-full object-cover">
            @else
                <span class="text-gray-500">Tidak ada foto</span>
            @endif

            <!-- Tampilkan Nama -->
            <h2 class="text-2xl font-semibold text-gray-800">{{ $user->nama }}</h2>

            <!-- Tampilkan Detail Pengguna -->
            <div class="w-full space-y-2">
                <div class="flex justify-between">
                    <span class="text-gray-600">Semester:</span>
                    <span class="text-gray-800">{{ $user->semester }}</span>
                </div>
                <div class="flex justify-between">
                    <span class="text-gray-600">Jurusan:</span>
                    <span class="text-gray-800">{{ $user->jurusan }}</span>
                </div>
                <div class="flex justify-between">
                    <span class="text-gray-600">Fakultas:</span>
                    <span class="text-gray-800">{{ $user->fakultas }}</span>
                </div>
                <div class="flex justify-between">
                    <span class="text-gray-600">Kelas:</span>
                    <span class="text-gray-800">{{ $user->kelas->nama_kelas }}</span>
                </div>
            </div>
        </div>

        <!-- Tombol Edit dan Hapus -->
        <div class="mt-6 flex justify-between">
            <a href="{{ route('user.edit', $user->id) }}" class="text-blue-500 hover:text-blue-700 font-medium transition">Edit</a>
            
            <form action="{{ route('user.destroy', $user->id) }}" method="POST">
                @csrf
                @method('DELETE')
                <button type="submit" class="text-red-500 hover:text-red-700 font-medium transition" onclick="return confirm('Apakah anda yakin ingin menghapus user ini?')">
                    Hapus
                </button>
            </form>
        </div>
    </div>
</div>
@endsection
