<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Fakultas;


class Fakultas extends Model
{
    use HasFactory;

    protected $table = 'fakultas';

    public function getFakultas(){
        return $this->all();
    }
}
