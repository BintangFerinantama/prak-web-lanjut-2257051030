<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateUserTableAddJurusanSemesterFakultasIdAndRemoveNpm extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('user', function (Blueprint $table) {
            // Hapus kolom 'npm' jika ada
            if (Schema::hasColumn('user', 'npm')) {
                $table->dropColumn('npm');
            }

            // Tambahkan kolom 'jurusan' jika belum ada
            if (!Schema::hasColumn('user', 'jurusan')) {
                $table->enum('jurusan', ['fisika', 'kimia', 'biologi', 'matematika', 'ilmu komputer'])->after('nama');
            }

            // Tambahkan kolom 'semester' jika belum ada
            if (!Schema::hasColumn('user', 'semester')) {
                $table->integer('semester')->unsigned()->check('semester <= 14')->after('jurusan');
            }

            // Tambahkan kolom 'fakultas_id' jika belum ada
            if (!Schema::hasColumn('user', 'fakultas_id')) {
                $table->foreignId('fakultas_id')->constrained('fakultas')->after('semester');
            }
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('user', function (Blueprint $table) {
            // Tambahkan kembali kolom 'npm' jika sebelumnya dihapus
            if (!Schema::hasColumn('user', 'npm')) {
                $table->string('npm')->unique()->after('nama');
            }

            // Hapus kolom 'jurusan', 'semester', dan 'fakultas_id' jika ada
            if (Schema::hasColumn('user', 'jurusan')) {
                $table->dropColumn('jurusan');
            }

            if (Schema::hasColumn('user', 'semester')) {
                $table->dropColumn('semester');
            }

            if (Schema::hasColumn('user', 'fakultas_id')) {
                $table->dropForeign(['fakultas_id']);
                $table->dropColumn('fakultas_id');
            }
        });
    }
}
