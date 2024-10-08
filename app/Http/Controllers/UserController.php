<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Kelas;
use App\Models\UserModel;

class UserController extends Controller
{
    public function index()
    {
        $data = [
            'title' => 'List User',
            'users' => $this->userModel->getUser(),
        ];
    
        return view('list_user', $data);
    }

    public function profile($nama = "", $kelas = "", $npm = ""){
        $data = [
            'nama' => $nama,
            'kelas' => $kelas,
            'npm' => $npm,
        ];
        
        return view('profile', $data);
    }

    public function create()
    {
        $kelas = new Kelas();

        $kelas = $kelas->getKelas();

        $data = [
            'title' => 'Create User',
            'kelas' => $kelas,
        ];
        
        return view('create_user', $data);
    }

    public function store(Request $request)
    {
        $this->userModel->create([ 
            'nama' => $request->input('nama'), 
            'npm' => $request->input('npm'), 
            'kelas_id' => $request->input('kelas_id'), 
            ]); 
        
            return redirect()->to('/user');
    }
    public $userModel;
    public $kelasModel;

    public function __construct()
    {
        $this->userModel = new UserModel;
        $this->kelasModel = new Kelas();
        $kelas = $this->kelasModel->getKelas();
        
    }
}
