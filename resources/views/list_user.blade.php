@extends('layouts.app')

@section('content')
<div class="container mx-auto p-6">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-3xl font-semibold text-blue-700">Daftar Pengguna</h1>
        <a href="{{ route('users.create') }}" 
           class="bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2 px-4 rounded-lg transition duration-200">
            Tambah Pengguna Baru
        </a>
    </div>

    @if(session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
            <span class="block sm:inline">{{ session('success') }}</span>
        </div>
    @endif

    <div class="overflow-x-auto bg-white shadow-lg rounded-xl">
        <table class="w-full table-auto border-collapse">
            <thead>
                <tr class="bg-blue-600 text-white">
                    <th class="px-4 py-3 text-sm font-semibold text-center">ID</th>
                    <th class="px-4 py-3 text-sm font-semibold text-center">Foto</th>
                    <th class="px-4 py-3 text-sm font-semibold text-center">Nama</th>
                    <th class="px-4 py-3 text-sm font-semibold text-center">Kelas</th>
                    <th class="px-4 py-3 text-sm font-semibold text-center">Semester</th>
                    <th class="px-4 py-3 text-sm font-semibold text-center">Jurusan</th>
                    <th class="px-4 py-3 text-sm font-semibold text-center">Fakultas</th>
                    <th class="px-4 py-3 text-sm font-semibold text-center">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-200">
                @if ($users && $users->count() > 0)
                    @foreach ($users as $user)
                        <tr class="hover:bg-gray-50">
                            <td class="px-4 py-3 text-center">{{ $user->id }}</td>
                            <td class="px-4 py-3 text-center">
                                @if ($user->foto)
                                    <img src="{{ asset('storage/' . $user->foto) }}" 
                                         alt="Foto {{ $user->nama }}" 
                                         class="h-12 w-12 rounded-full object-cover mx-auto">
                                @else
                                    <div class="h-12 w-12 rounded-full bg-gray-200 flex items-center justify-center mx-auto">
                                        <span class="text-gray-500 text-xs">No Photo</span>
                                    </div>
                                @endif
                            </td>
                            <td class="px-4 py-3 text-center">{{ $user->nama }}</td>
                            <td class="px-4 py-3 text-center">{{ $user->kelas->nama_kelas }}</td>
                            <td class="px-4 py-3 text-center">{{ $user->semester }}</td>
                            <td class="px-4 py-3 text-center">{{ $user->jurusan }}</td>
                            <td class="px-4 py-3 text-center">{{ $user->fakultas->nama_fakultas }}</td>
                            <td class="px-4 py-3 text-center">
                                <div class="flex justify-center space-x-2">
                                    <a href="{{ route('user.show', $user->id) }}" 
                                       class="bg-green-500 hover:bg-green-600 text-white px-3 py-1 rounded-md text-sm transition duration-200">
                                        View
                                    </a>
                                    <a href="{{ route('user.edit', $user->id) }}" 
                                       class="bg-blue-500 hover:bg-blue-600 text-white px-3 py-1 rounded-md text-sm transition duration-200">
                                        Edit
                                    </a>
                                    <form action="{{ route('user.destroy', $user->id) }}" method="POST" class="inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" 
                                                class="bg-red-500 hover:bg-red-600 text-white px-3 py-1 rounded-md text-sm transition duration-200"
                                                onclick="return confirm('Apakah anda yakin ingin menghapus user ini?')">
                                            Delete
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                @else
                    <tr>
                        <td colspan="9" class="text-center py-4 text-gray-500">Tidak ada pengguna yang ditemukan.</td>
                    </tr>
                @endif
            </tbody>
        </table>
    </div>
</div>
@endsection