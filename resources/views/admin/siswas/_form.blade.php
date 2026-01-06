@php
    // Expect variables: $siswa (optional), $users (list for wali kelas)
    $old = old();
    $siswa = $siswa ?? null;
    $value = function ($key, $default = '') use ($old, $siswa) {
        if (array_key_exists($key, $old)) return $old[$key];
        if ($siswa && isset($siswa->{$key})) return $siswa->{$key};
        return $default;
    };
@endphp

<div class="grid grid-cols-1 gap-4">
    <div>
        <label class="block text-sm font-medium text-gray-700">NIS</label>
        <input name="nis" value="{{ $value('nis') }}" class="mt-1 block w-full border rounded-md p-2" />
        @error('nis') <span class="text-sm text-red-500">{{ $message }}</span> @enderror
    </div>

    <div>
        <label class="block text-sm font-medium text-gray-700">Nama Lengkap</label>
        <input name="nama_lengkap" value="{{ $value('nama_lengkap') }}" class="mt-1 block w-full border rounded-md p-2" />
        @error('nama_lengkap') <span class="text-sm text-red-500">{{ $message }}</span> @enderror
    </div>

    <div>
        <label class="block text-sm font-medium text-gray-700">Kelas</label>
        <input name="kelas" value="{{ $value('kelas') }}" class="mt-1 block w-full border rounded-md p-2" />
        @error('kelas') <span class="text-sm text-red-500">{{ $message }}</span> @enderror
    </div>

    <div>
        <label class="block text-sm font-medium text-gray-700">Jurusan</label>
        <input name="jurusan" value="{{ $value('jurusan') }}" class="mt-1 block w-full border rounded-md p-2" />
        @error('jurusan') <span class="text-sm text-red-500">{{ $message }}</span> @enderror
    </div>

    <div>
        <label class="block text-sm font-medium text-gray-700">Email</label>
        <input name="email" value="{{ $value('email') }}" class="mt-1 block w-full border rounded-md p-2" />
        @error('email') <span class="text-sm text-red-500">{{ $message }}</span> @enderror
    </div>

    <div>
        <label class="block text-sm font-medium text-gray-700">Alamat</label>
        <textarea name="alamat" class="mt-1 block w-full border rounded-md p-2">{{ $value('alamat') }}</textarea>
        @error('alamat') <span class="text-sm text-red-500">{{ $message }}</span> @enderror
    </div>

    <div>
        <label class="block text-sm font-medium text-gray-700">No HP</label>
        <input name="no_hp" value="{{ $value('no_hp') }}" class="mt-1 block w-full border rounded-md p-2" />
        @error('no_hp') <span class="text-sm text-red-500">{{ $message }}</span> @enderror
    </div>

    <div>
        <label class="block text-sm font-medium text-gray-700">Tanggal Lahir</label>
        <input type="date" name="tgl_lahir" value="{{ $value('tgl_lahir') }}" class="mt-1 block w-full border rounded-md p-2" />
        @error('tgl_lahir') <span class="text-sm text-red-500">{{ $message }}</span> @enderror
    </div>

    <div>
        <label class="block text-sm font-medium text-gray-700">Jenis Kelamin</label>
        <select name="jenis_kelamin" class="mt-1 block w-full border rounded-md p-2">
            <option value="">Pilih</option>
            <option value="Laki-laki" {{ ($value('jenis_kelamin') === 'Laki-laki') ? 'selected' : '' }}>Laki-laki</option>
            <option value="Perempuan" {{ ($value('jenis_kelamin') === 'Perempuan') ? 'selected' : '' }}>Perempuan</option>
        </select>
        @error('jenis_kelamin') <span class="text-sm text-red-500">{{ $message }}</span> @enderror
    </div>

    <div>
        <label class="block text-sm font-medium text-gray-700">Wali Kelas (User)</label>
        <select name="wali_kelas" class="mt-1 block w-full border rounded-md p-2">
            <option value="">Tidak ada</option>
            @if(isset($users) && $users->count())
                @foreach($users as $userOption)
                            <option value="{{ $userOption->id }}" {{ ((string)$value('wali_kelas') === (string)$userOption->id) ? 'selected' : '' }}>{{ $userOption->name }} &lt;{{ $userOption->email }}&gt;</option>
                @endforeach
            @endif
        </select>
        @error('wali_kelas') <span class="text-sm text-red-500">{{ $message }}</span> @enderror
    </div>

    <div>
        <label class="block text-sm font-medium text-gray-700">Status</label>
        <input name="status" value="{{ $value('status', 'Aktif') }}" class="mt-1 block w-full border rounded-md p-2" />
        @error('status') <span class="text-sm text-red-500">{{ $message }}</span> @enderror
    </div>

    <div class="pt-2">
        <button type="submit" class="px-4 py-2 bg-indigo-600 text-white rounded-md">{{ $submitButtonText ?? 'Simpan' }}</button>
        <a href="{{ route('admin.siswas.index') }}" class="ml-2 px-4 py-2 border rounded-md">Kembali</a>
    </div>
</div>
