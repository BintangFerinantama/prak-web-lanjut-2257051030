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
                    <th class="px-6 py-4 text-sm font-semibold text-center">Aksi</th>
                </tr>
            </thead>    
            <tbody class="bg-blue-100 divide-y divide-blue-300">
                <?php foreach ($users as $user) { ?>
                    <tr class="odd:bg-blue-50 even:bg-blue-100">
                        <td class="px-6 py-4 text-blue-900 text-center"><?= $user['id'] ?></td>
                        <td class="px-6 py-4 text-blue-900 text-center"><?= $user['nama'] ?></td>
                        <td class="px-6 py-4 text-blue-900 text-center"><?= $user['npm'] ?></td>
                        <td class="px-6 py-4 text-blue-900 text-center"><?= $user['nama_kelas'] ?></td>
                        <td class="px-6 py-4 text-center">
                            <a href="#" class="text-blue-500 hover:text-blue-700 font-medium transition">Edit</a> |
                            <a href="#" class="text-red-500 hover:text-red-700 font-medium transition">Delete</a>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
</div>
@endsection
