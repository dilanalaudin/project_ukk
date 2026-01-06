<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (! Schema::hasTable('siswas')) {
            Schema::create('siswas', function (Blueprint $table) {
                $table->id();
                $table->unsignedBigInteger('user_id')->nullable()->index();
                $table->string('nis')->unique();
                $table->string('nama_lengkap');
                $table->string('kelas')->nullable();
                $table->string('jurusan')->nullable();
                $table->string('email')->nullable();
                $table->string('no_hp')->nullable();
                $table->date('tgl_lahir')->nullable();
                $table->string('jenis_kelamin')->nullable();
                $table->unsignedBigInteger('wali_kelas')->nullable();
                $table->string('status')->nullable();
                $table->timestamps();

                $table->foreign('user_id')->references('id')->on('users')->onDelete('set null');
                $table->foreign('wali_kelas')->references('id')->on('users')->onDelete('set null');
            });
        }
    }

    public function down(): void
    {
        Schema::dropIfExists('siswas');
    }
};