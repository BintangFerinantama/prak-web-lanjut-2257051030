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
        if (!Schema::hasColumn('user', 'fakultas_id')) {
            $table->foreignId('fakultas_id')
                  ->constrained('fakultas');
        }
        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        if (Schema::hasColumn('user', 'fakultas_id')) {
            $table->dropForeign(['fakultas_id']);
            $table->dropColumn('fakultas_id');
        }
        
    }
};
