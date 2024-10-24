@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gray-50 py-12 px-4 sm:px-6 lg:px-8">
    <div class="max-w-md mx-auto bg-white rounded-xl shadow-md overflow-hidden md:max-w-2xl">
        <div class="px-8 py-6">
            <h2 class="text-2xl font-bold text-gray-800 mb-6">Create User</h2>
            
            <form action="{{ route('user.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                @csrf
                
                <!-- Nama Field -->
                <div class="space-y-2">
                    <label for="nama" class="block text-sm font-medium text-gray-700">Nama</label>
                    <input type="text" 
                           id="nama" 
                           name="nama" 
                           required 
                           class="mt-1 block w-full px-3 py-2 bg-white border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                </div>


                <!-- Kelas Field -->
                <div class="space-y-2">
                    <label for="kelas_id" class="block text-sm font-medium text-gray-700">Kelas</label>
                    <select name="kelas_id" 
                            id="kelas_id" 
                            required 
                            class="mt-1 block w-full px-3 py-2 bg-white border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                        @foreach ($kelas as $kelasItem)
                            <option value="{{$kelasItem->id}}">{{$kelasItem->nama_kelas}}</option>
                        @endforeach
                    </select>
                </div>

                <!-- Semester Field -->
                <div class="space-y-2">
                    <label for="semester" class="block text-sm font-medium text-gray-700">Semester</label>
                    <input type="text" 
                           id="semester" 
                           name="semester" 
                           required 
                           class="mt-1 block w-full px-3 py-2 bg-white border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                </div>

                <!-- Jurusan Field -->
                <div class="space-y-2">
                    <label for="jurusan" class="block text-sm font-medium text-gray-700">Jurusan</label>
                    <input type="text" 
                           id="jurusan" 
                           name="jurusan" 
                           required 
                           class="mt-1 block w-full px-3 py-2 bg-white border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                </div>

                <!-- Fakultas Field -->
                <div class="space-y-2">
                    <label for="fakultas" class="block text-sm font-medium text-gray-700">Fakultas</label>
                    <input type="text" 
                           id="fakultas" 
                           name="fakultas" 
                           required 
                           class="mt-1 block w-full px-3 py-2 bg-white border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                </div>

                <!-- Foto Field -->
                <div class="space-y-2">
                    <label for="foto">Foto:</label>
                    <input type="file" id="foto" name="foto">
                </div>

                <!-- Submit Button -->
                <div class="pt-4">
                    <button type="submit" 
                            class="w-full flex justify-center py-2 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transition duration-150 ease-in-out">
                        Create User
                    </button>   
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
