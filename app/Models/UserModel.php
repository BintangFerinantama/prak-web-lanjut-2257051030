<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserModel extends Model
{
    use HasFactory;

    protected $table = 'user';
    protected $guarded = ['id'];

    protected $fillable = [
        'nama',
        'semester',
        'kelas_id',
        'foto',
        'jurusan',
        'fakultas_id',
    ];

    public function getUser($id = null){
        return $this->join('kelas', 'kelas.id', '=', 'user.kelas_id')
        ->select('user.*', 'kelas.nama_kelas as nama_kelas')->get()
        ->where('user.id', $id)
        ->first();

        return $this->join('fakultas', 'fakultas.id', '=', 'user.fakultas_id')
        ->select('user.*', 'fakultas.nama_fakultas as nama_fakultas')->get()
        ->where('user.id', $id)
        ->first();
    }


    public function kelas(){
        return $this->belongsTo(Kelas::class, 'kelas_id');
    }


    public function fakultas(){
        return $this->belongsTo(Kelas::class, 'fakultas_id');
    }
}