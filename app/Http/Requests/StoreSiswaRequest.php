<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreSiswaRequest extends FormRequest
{
    public function authorize()
    {
        // Hanya admin boleh menyimpan siswa
        return $this->user() && ($this->user()->role ?? '') === 'admin';
    }

    public function rules()
    {
        return [
            'user_id'       => 'nullable|exists:users,id',
            'nis'           => 'required|unique:siswas,nis|max:50',
            'nama_lengkap'  => 'required|string|max:255',
            'kelas'         => 'required|string|max:50',
            'jurusan'       => 'nullable|string|max:100',
            'alamat'        => 'nullable|string',
            'no_hp'         => 'nullable|string|max:20',
            'tgl_lahir'     => 'nullable|date',
            'jenis_kelamin' => 'nullable|string|max:20',
            'wali_kelas'    => 'nullable|exists:users,id',
        ];
    }
}