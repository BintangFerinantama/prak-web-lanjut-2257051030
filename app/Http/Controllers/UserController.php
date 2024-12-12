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
        'semester' => 'required|integer|min:1|max:14', // Validasi semester
        'jurusan' => 'required|string|max:255',
        'fakultas' => 'required|string|max:255',
        'kelas_id' => 'required|integer|exists:kelas,id',
        'foto' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
    ]);

    // Mengelola file upload (jika ada)
    $fotoPath = null; // Default value untuk fotoPath

    if ($request->hasFile('foto')) {
        $foto = $request->file('foto');
        $filename = time() . '_' . $foto->getClientOriginalName();
        $foto->storeAs('uploads', $filename);
        $fotoPath = $filename; // Menyimpan path foto
    }

    // Simpan data pengguna
    $this->userModel->create([
        'nama' => $request->input('nama'),
        'semester' => $request->input('semester'),
        'jurusan' => $request->input('jurusan'),
        'fakultas' => $request->input('fakultas'),
        'kelas_id' => $request->input('kelas_id'),
        'foto' => $fotoPath ? 'upload/img/' . $filename : null,
    ]);

    return redirect()->to('/')->with('success', 'User berhasil ditambahkan');
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
    return view('edit_user', compact('user', 'kelas', 'title'));
}


    public function update(Request $request, $id)
{
    // Validasi input
    $request->validate([
        'nama' => 'required|string|max:255',
        'semester' => 'required|integer|min:1|max:14',
        'jurusan' => 'required|string|max:255',
        'fakultas' => 'required|string|max:255',
        'kelas_id' => 'required|integer|exists:kelas,id',
        'foto' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
    ]);

    $user = UserModel::findOrFail($id);

    // Update data
    $user->nama = $request->nama;
    $user->semester = $request->semester;
    $user->jurusan = $request->jurusan;
    $user->fakultas = $request->fakultas;
    $user->kelas_id = $request->kelas_id;

    // Mengelola file foto
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
