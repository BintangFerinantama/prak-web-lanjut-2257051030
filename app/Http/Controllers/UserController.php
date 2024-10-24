<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Kelas;
use App\Models\Fakultas; // Tambahkan ini di bagian atas file
use App\Models\UserModel;
use Illuminate\Support\Facades\Storage;

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
            'users' => $this->userModel->all(),
        ];
    
        return view('list_user', $data);
    }

    // Menampilkan profil pengguna
    public function profile($nama = "", $kelas = "", $semester = "", $fakultas = "", $jurusan = "")
    {
        $data = [
            'nama' => $nama,
            'kelas' => $kelas,
            'semester' => $semester,
            'fakultas' => $fakultas,
            'jurusan' => $jurusan,
        ];
        
        return view('profile', $data);
    }

    // Menampilkan form untuk membuat pengguna baru
    public function create()
    {
        $kelas = $this->kelasModel->all(); // Mengambil semua kelas
        // Mengambil semua fakultas

        $data = [
            'title' => 'Create User',
            'kelas' => $kelas, // Kirimkan data fakultas ke view
        ];
        
        return view('create_user', $data);
    }

    // Menyimpan data pengguna baru
    public function store(Request $request)
    {
        // Validasi input
        $request->validate([
            'nama' => 'required|string|max:255',
            'kelas_id' => 'required|integer|exists:kelas,id',
            'semester' => 'required|string|max:255',
            'jurusan' => 'required|string|max:255',
            'fakultas_id' => 'required|integer|exists:fakultas,id', // Pastikan fakultas_id valid
            'foto' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        // Mengelola file upload (jika ada)
        $fotoPath = null;

        if ($request->hasFile('foto')) {
            $foto = $request->file('foto');
            $filename = time() . '_' . $foto->getClientOriginalName();
            $foto->storeAs('uploads', $filename);
            $fotoPath = $filename;
        }

        // Simpan data pengguna
        $this->userModel->create([
            'nama' => $request->input('nama'),
            'kelas_id' => $request->input('kelas_id'),
            'semester' => $request->input('semester'),
            'jurusan' => $request->input('jurusan'),
            'fakultas_id' => $request->input('fakultas_id'),
            'foto' => $fotoPath, // Menyimpan path foto jika ada
        ]);

        return redirect()->route('user.list')->with('success', 'User berhasil ditambahkan');
    }

    // Menampilkan detail pengguna
    public function show($id)
    {
        $user = UserModel::findOrFail($id);
        $kelas = Kelas::find($user->kelas_id);
        $title = 'Detail ' . $user->nama;

        return view('show_user', compact('user', 'kelas', 'title'));
    }

    // Menampilkan form untuk mengedit pengguna
    public function edit($id)
    {
        $user = UserModel::findOrFail($id);
        $kelas = Kelas::all();
        $fakultas = Fakultas::all(); // Tambahkan pengambilan fakultas
        $title = 'Edit User';

        return view('edit_user', compact('user', 'kelas', 'fakultas', 'title'));
    }

    // Memperbarui data pengguna
    public function update(Request $request, $id)
    {
        $user = UserModel::findOrFail($id);

        $user->nama = $request->nama;
        $user->kelas_id = $request->kelas_id;
        $user->semester = $request->semester;
        $user->jurusan = $request->jurusan;
        $user->fakultas_id = $request->fakultas_id;

        if ($request->hasFile('foto')) {
            $filename = time() . '.' . $request->foto->extension();
            $request->foto->move(public_path('uploads'), $filename);
            $user->foto = 'uploads/' . $filename;
        }

        $user->save();

        return redirect()->route('user.list')->with('success', 'User updated successfully');
    }

    // Menghapus pengguna
    public function destroy($id)
    {
        $user = UserModel::findOrFail($id);
        $user->delete();

        return redirect()->to('/user/list')->with('success', 'User has been deleted successfully');
    }
}
