@extends('layouts.app')

@section('content')
<div class="container mx-auto p-6">
    <h1 class="text-3xl font-semibold text-blue-700 mb-6">Daftar Pengguna</h1>
    <div class="overflow-x-auto bg-blue-50 shadow-lg rounded-xl">
        <table class="w-full table-auto border-collapse">
            <thead>
                <tr class="bg-blue-600 text-white">
                    <th class="px-6 py-4 text-sm font-semibold text-center">ID</th>
                    <th class="px-6 py-4 text-sm font-semibold text-center">Nama</th>
                    <th class="px-6 py-4 text-sm font-semibold text-center">NPM</th>
                    <th class="px-6 py-4 text-sm font-semibold text-center">Kelas</th>
                    <th class="px-6 py-4 text-sm font-semibold text-center">Foto</th> <!-- Kolom Foto -->
                    <th class="px-6 py-4 text-sm font-semibold text-center">Aksi</th>
                </tr>
            </thead>
            <tbody class="bg-blue-100 divide-y divide-blue-300">
                @if ($users && $users->count() > 0)
                    @foreach ($users as $user)
                        <tr class="odd:bg-blue-50 even:bg-blue-100">
                            <td class="px-6 py-4 text-blue-900 text-center">{{ $user->id }}</td>
                            <td class="px-6 py-4 text-blue-900 text-center">{{ $user->nama }}</td>
                            <td class="px-6 py-4 text-blue-900 text-center">{{ $user->npm }}</td>
                            <td class="px-6 py-4 text-blue-900 text-center">{{ $user->kelas->nama_kelas }}</td>
                            <td class="px-6 py-4 text-blue-900 text-center">
                                @if ($user->foto)
                                    <img src="{{ asset('upload/img/' . basename($user->foto)) }}" alt="Foto Pengguna" class="h-16 w-16 rounded-full object-cover mx-auto">
                                @else
                                    <span>Tidak ada foto</span>
                                @endif
                            </td>
                            <td class="px-6 py-4 text-center">
                                <a href="{{ route('user.show', $user['id']) }}" class="btn btn-primary btn-sm mb-3">View</a>
                                <a href="{{ route('user.edit', $user['id']) }}" class="text-blue-500 hover:text-blue-700 font-medium transition">Edit</a>
                                
                                <form action="{{ route('user.destroy', $user['id']) }}" method="POST" style="display:inline-block;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-500 hover:text-red-700 font-medium transition btn btn-danger btn-sm"
                                    onclick="return confirm('Apakah anda yakin ingin menghapus user ini?')">Delete</button>

                                </form>

                                <a href="{{ route('users.create') }}" class="btn btn-primary mb-3">Tambah Pengguna Baru</a>
                            </td>
                        </tr>
                    @endforeach
                @else
                    <tr>
                        <td colspan="6" class="text-center py-4 text-blue-900">Tidak ada pengguna yang ditemukan.</td> <!-- Sesuaikan colspan menjadi 6 -->
                    </tr>
                @endif
            </tbody>
        </table>
    </div>
</div>
@endsection
