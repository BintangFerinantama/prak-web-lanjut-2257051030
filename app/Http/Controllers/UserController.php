<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Kelas;
use App\Models\UserModel; // Pastikan ini sesuai dengan Model Anda
use Illuminate\Support\Facades\Storage; // Untuk mengelola file storage

class UserController extends Controller
{
    protected $userModel;
    protected $kelasModel;

    // Dependency Injection
    public function __construct(UserModel $userModel, Kelas $kelasModel)
    {
        $this->userModel = $userModel;
        $this->kelasModel = $kelasModel;
    }

    // Menampilkan daftar pengguna
    public function index()
    {
        $data = [
            'title' => 'List User',
            'users' => $this->userModel->all(), // Mengambil semua user dengan metode bawaan Eloquent
        ];
    
        return view('list_user', $data);
    }

    // Menampilkan profil pengguna
    public function profile($nama = "", $kelas = "", $npm = "")
    {
        $data = [
            'nama' => $nama,
            'kelas' => $kelas,
            'npm' => $npm,
        ];
        
        return view('profile', $data);
    }

    // Menampilkan form untuk membuat pengguna baru
    public function create()
    {
        $kelas = $this->kelasModel->all(); // Mengambil semua kelas

        $data = [
            'title' => 'Create User',
            'kelas' => $kelas,
        ];
        
        return view('create_user', $data);
    }

    // Menyimpan data pengguna baru
    public function store(Request $request)
    {
        // Validasi input
        $request->validate([
            'nama' => 'required|string|max:255',
            'npm' => 'required|string|max:255|unique:user,npm', // NPM harus unik
            'kelas_id' => 'required|integer|exists:kelas,id', // Pastikan kelas_id ada di tabel kelas
            'foto' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        // Mengelola file upload (jika ada)
        $fotoPath = null; // Default value untuk fotoPath

        if ($request->hasFile('foto')) {
            $foto = $request->file('foto');
            //Store foto in  dir uploads
            $fotoPath = $foto->move(('upload/img'), $foto);
        } else {
            $fotoPath = null;
        }
        // Menyimpan data ke database termasuk path foto
            $this->userModel->create([
            'nama' => $request->input('nama'),
            'npm' => $request->input('npm'),
            'kelas_id' => $request->input('kelas_id'),
            'foto' => $fotoPath, // Menyimpan path foto
            ]);
            return redirect()->to('/user')->with('success', 'User berhasil ditambahkan');
    }

    // Menampilkan detail pengguna
    public function show($id)
    {
        $user = UserModel::findOrFail($id);
        $kelas = kelas::find($user->kelas_id);

        $title = 'Detail '.$user->nama;
        
        return view('show_user', compact('user', 'kelas','title'));
    }

    public function edit($id)
    {
        $user = UserModel::findOrFail($id);
        $kelasModel = new Kelas();
        $kelas = $kelasModel->getKelas();
        $title = 'Edit User';
        return view('edit_user', compact('user','kelas','title'));
    }

    public function update(Request $request, $id)
    {
        $user = UserModel::findOrFail($id);

        $user->nama = $request->nama;
        $user->npm = $request->npm;
        $user->kelas_id = $request->kelas_id;

        if ($request->hasFile('foto')) {
            $fileName = time() . '.' . $request->foto->extension();
            $request->foto->move(public_path('uploads'), $fileName);
            $user->foto = 'uploads/' . $fileName;
        }

        $user->save();

        return redirect()->route('user.list')->with('success', 'User updated successfully');
    }

    public function destroy($id)
    {
        $user = UserModel::findOrFail($id);
        $user->delete();

        return redirect()->to('/user/list')->with('success', 'User has been deleted successfully');
    }
}
