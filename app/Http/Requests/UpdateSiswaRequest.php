<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateSiswaRequest extends FormRequest
{
    public function authorize()
    {
        return $this->user() && ($this->user()->role ?? '') === 'admin';
    }

    public function rules()
    {
        $siswaId = $this->route('siswa')->getKey();

        return [
            'user_id'       => 'nullable|exists:users,id',
            'nis'           => ['required', 'max:50', Rule::unique('siswas', 'nis')->ignore($siswaId, 'id')],
            'nama_lengkap'  => 'required|string|max:255',
            'kelas'         => 'required|string|max:50',
            'jurusan'       => 'nullable|string|max:100',
            'email'         => ['nullable', 'email', Rule::unique('siswas', 'email')->ignore($siswaId, 'id')],
            'alamat'        => 'nullable|string',
            'no_hp'         => 'nullable|string|max:20',
            'tgl_lahir'     => 'nullable|date',
            'jenis_kelamin' => 'nullable|string|max:20',
            'wali_kelas'    => 'nullable|exists:users,id',
            'status'        => 'nullable|string|max:50',
        ];
    }
}