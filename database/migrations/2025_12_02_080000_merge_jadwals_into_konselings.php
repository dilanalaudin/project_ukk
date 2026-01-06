<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // Add 'type' column to konselings if not exists
        if (Schema::hasTable('konselings') && ! Schema::hasColumn('konselings', 'type')) {
            Schema::table('konselings', function (Blueprint $table) {
                $table->string('type')->default('note')->after('keterangan')->index();
            });
        }

        // If jadwals exist, copy them to konselings table as type 'jadwal'
        if (Schema::hasTable('jadwals') && Schema::hasTable('konselings')) {
            $jadwals = DB::table('jadwals')->get();
            foreach ($jadwals as $jad) {
                DB::table('konselings')->insert([
                    'siswa_id' => $jad->siswa_id,
                    'tanggal' => $jad->tanggal,
                    'jenis' => $jad->jenis,
                    'keterangan' => $jad->keterangan,
                    'type' => 'jadwal',
                    'created_at' => $jad->created_at,
                    'updated_at' => $jad->updated_at,
                ]);
            }

            // drop jadwals table after migration
            Schema::dropIfExists('jadwals');
        }
    }

    public function down(): void
    {
        // On rollback, attempt to recreate jadwals and move jadwal entries back
        if (Schema::hasTable('konselings') && ! Schema::hasTable('jadwals')) {
            Schema::create('jadwals', function (Blueprint $table) {
                $table->id();
                $table->unsignedBigInteger('siswa_id');
                $table->date('tanggal');
                $table->string('jenis')->nullable();
                $table->string('keterangan')->nullable();
                $table->timestamps();
            });

            $jadwalRows = DB::table('konselings')->where('type', 'jadwal')->get();
            foreach ($jadwalRows as $row) {
                DB::table('jadwals')->insert([
                    'siswa_id' => $row->siswa_id,
                    'tanggal' => $row->tanggal,
                    'jenis' => $row->jenis,
                    'keterangan' => $row->keterangan,
                    'created_at' => $row->created_at,
                    'updated_at' => $row->updated_at,
                ]);
            }
        }

        if (Schema::hasTable('konselings') && Schema::hasColumn('konselings', 'type')) {
            Schema::table('konselings', function (Blueprint $table) {
                $table->dropColumn('type');
            });
        }
    }
};
