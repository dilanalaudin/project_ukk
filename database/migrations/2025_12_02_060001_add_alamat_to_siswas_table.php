<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (Schema::hasTable('siswas') && ! Schema::hasColumn('siswas', 'alamat')) {
            Schema::table('siswas', function (Blueprint $table) {
                // Alamat bisa jadi cukup text karena sering panjang
                $table->text('alamat')->nullable()->after('jurusan');
            });
        }
    }

    public function down(): void
    {
        if (Schema::hasTable('siswas') && Schema::hasColumn('siswas', 'alamat')) {
            Schema::table('siswas', function (Blueprint $table) {
                $table->dropColumn('alamat');
            });
        }
    }
};
