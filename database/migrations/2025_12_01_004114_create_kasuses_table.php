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
        Schema::create('kasus', function (Blueprint $table) {
           $table->id();
           $table->unsignedBigInteger('siswa_id');
           $table->string('jenis'); // contoh: Bolos, Perundungan
           $table->string('severity')->default('ringan'); // ringan / berat
           $table->string('status')->default('proses'); // proses / selesai
           $table->date('tanggal')->nullable();
           $table->timestamps();

           $table->foreign('siswa_id')->references('id')->on('siswas')->onDelete('cascade');
        });
    }
};
