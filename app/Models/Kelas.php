<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Kelas;


class Kelas extends Model
{
    use HasFactory;

    protected $table = 'kelas';

    public function getKelas(){
        return $this->all();
    }
}
