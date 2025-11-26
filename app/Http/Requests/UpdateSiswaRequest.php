<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateSiswaRequest extends FormRequest
{
    public function authorize()
    {
        // Hanya admin boleh mengupdate siswa
        return $this->user() && ($this->user()->role ?? '') === 'admin';
    }

    public function rules()
    {
        $siswaId = $this->route('siswa')->getKey();

        return [
            'user_id'       => 'nullable|exists:users,id',
            'nis'           => ['required', 'max:50', Rule::unique('siswas', 'nis')->ignore($siswaId)],
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