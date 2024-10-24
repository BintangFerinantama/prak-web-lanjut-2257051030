<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Fakultas;


class FakultasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            'FMIPA',
            'FT',
            'FP',
            'FK',
            'FEB',
        ];

        foreach ($data as $fakultas) {
            Fakultas::create([
                'nama_fakultas' => $fakultas,

            ]);
        }


    }
}
