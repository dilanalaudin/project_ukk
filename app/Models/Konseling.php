<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Konseling extends Model
{
    public const TYPE_JADWAL = 'jadwal';
    public const TYPE_NOTE = 'note';
    public const TYPE_KONSELING = 'konseling';

    protected $fillable = [
        'siswa_id',
        'tanggal',
        'jenis',
        'keterangan',
        'type',
        'topik',
        'ringkasan_masalah',
        'solusi',
        'jadwal_berikutnya',
        'status'
    ];

    protected $casts = [
        'tanggal' => 'date',
        'jadwal_berikutnya' => 'date',
    ];

    /**
     * Scope for jadwals (scheduled counseling)
     */
    public function scopeJadwal($query)
    {
        return $query->where('type', self::TYPE_JADWAL);
    }

    /**
     * Scope for notes (past counseling records)
     */
    public function scopeNote($query)
    {
        return $query->where('type', self::TYPE_NOTE)->orWhere('type', self::TYPE_KONSELING);
    }

    public function isJadwal(): bool
    {
        return $this->type === self::TYPE_JADWAL;
    }

    public function isNote(): bool
    {
        return in_array($this->type, [self::TYPE_NOTE, self::TYPE_KONSELING], true);
    }

    public function siswa()
    {
        return $this->belongsTo(Siswa::class, 'siswa_id', 'id');
    }
}
