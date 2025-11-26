<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Siswa extends Model
{
    use HasFactory;

    protected $table = 'siswas';
    protected $primaryKey = 'siswa_id';
    public $incrementing = true;
    protected $keyType = 'int';

    protected $fillable = [
        'user_id',
        'nis',
        'nama_lengkap',
        'kelas',
        'jurusan',
        'alamat',
        'email',
        'no_hp',
        'tgl_lahir',
        'jenis_kelamin',
        'wali_kelas',
        'status'
    ];

    protected $casts = [
        'tgl_lahir' => 'date',
    ];

    // Relasi ke User (akun siswa)
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    // Relasi ke wali kelas (juga tabel users)
    public function waliKelas()
    {
        return $this->belongsTo(User::class, 'wali_kelas');
    }
}