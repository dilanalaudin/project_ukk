<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Kasus extends Model
{
    protected $table = 'kasus';

    protected $fillable = [
        'siswa_id',
        'jenis',
        'severity',
        'poin',
        'status',
        'tanggal',
        'deskripsi'
    ];

    protected $casts = [
        'tanggal' => 'date',
    ];

    public function siswa()
    {
        return $this->belongsTo(Siswa::class, 'siswa_id');
    }
}
