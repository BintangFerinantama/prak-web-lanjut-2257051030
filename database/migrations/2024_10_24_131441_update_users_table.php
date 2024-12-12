<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('user', function (Blueprint $table) {
            // Menghapus kolom npm
            $table->dropColumn('npm');

            // Menambahkan kolom baru
            $table->enum('jurusan', ['fisika', 'kimia', 'biologi', 'matematika', 'ilmu komputer']);
            $table->integer('semester')->unsigned()->check('semester <= 14');
            $table->foreignId('fakultas_id')->constrained('fakultas');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('user', function (Blueprint $table) {
            // Mengembalikan kolom npm
            $table->string('npm');

            // Menghapus kolom baru
            $table->dropColumn('jurusan');
            $table->dropColumn('semester');
            $table->dropForeign(['fakultas_id']);
            $table->dropColumn('fakultas_id');
        });
    }
};