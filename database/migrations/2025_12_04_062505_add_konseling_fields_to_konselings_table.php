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
        Schema::table('konselings', function (Blueprint $table) {
            // Topik: belajar, sosial, pribadi, keluarga
            $table->string('topik')->nullable()->after('jenis');
            // Ringkasan masalah dari siswa atau BK
            $table->text('ringkasan_masalah')->nullable()->after('topik');
            // Solusi atau tindak lanjut dari BK
            $table->text('solusi')->nullable()->after('ringkasan_masalah');
            // Jadwal temu berikutnya
            $table->date('jadwal_berikutnya')->nullable()->after('solusi');
            // Status: proses, disetujui, ditolak, selesai
            $table->string('status')->default('proses')->after('jadwal_berikutnya');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('konselings', function (Blueprint $table) {
            $table->dropColumn(['topik', 'ringkasan_masalah', 'solusi', 'jadwal_berikutnya', 'status']);
        });
    }
};
