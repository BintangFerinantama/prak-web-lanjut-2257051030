@extends('layouts.app')

@section('content')
<div class="container mx-auto p-6">
    <h1 class="text-3xl font-semibold text-blue-700 mb-6">Detail Pengguna: {{ $user->nama }}</h1>
    
    <div class="bg-blue-50 shadow-lg rounded-xl p-6">
        <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
            <!-- Bagian Detail Pengguna -->
            <div>
                <h2 class="text-xl font-semibold text-blue-600 mb-4">Informasi Pengguna</h2>
                <p><strong>ID: </strong>{{ $user->id }}</p>
                <p><strong>Nama: </strong>{{ $user->nama }}</p>
                <p><strong>NPM: </strong>{{ $user->npm }}</p>
                <p><strong>Kelas: </strong>{{ $kelas ? $kelas->nama_kelas : 'Kelas tidak ditemukan' }}</p>
            </div>

            <!-- Bagian Foto Pengguna -->
            <div class="text-center">
                <h2 class="text-xl font-semibold text-blue-600 mb-4">Foto Pengguna</h2>
                @if ($user->foto)
                    <img src="{{ asset('upload/img/' . basename($user->foto)) }}" alt="Foto {{ $user->nama }}" class="h-16 w-16 object-cover mx-auto">
                @else
                    <span>Tidak ada foto</span>
                @endif
            </div>
        </div>

        <!-- Tombol Aksi -->
        <div class="mt-6">
            <a href="{{ route('user.edit', $user->id) }}" class="btn btn-primary">Edit</a>
            <a href="{{ route('user.list') }}" class="btn btn-secondary">Kembali ke Daftar Pengguna</a>
        </div>
    </div>
</div>
@endsection
