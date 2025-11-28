@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Edit Perangkat Desa</h2>

    <form action="{{ route('perangkat.update', $perangkat->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        
        <div class="row">
            <div class="col-md-6">
                <div class="mb-3">
                    <label for="warga_id" class="form-label">Nama Warga *</label>
                    <select name="warga_id" id="warga_id" class="form-select" required>
                        <option value="">Pilih Warga</option>
                        @foreach($warga as $w)
                            <option value="{{ $w->id }}" {{ $perangkat->warga_id == $w->id ? 'selected' : '' }}>
                                {{ $w->nama }}
                            </option>
                        @endforeach
                    </select>
                    @error('warga_id')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            
            <div class="col-md-6">
                <div class="mb-3">
                    <label for="jabatan" class="form-label">Jabatan *</label>
                    <select name="jabatan" id="jabatan" class="form-select" required>
                        <option value="">Pilih Jabatan</option>
                        @foreach($jabatanOptions as $jabatan)
                            <option value="{{ $jabatan }}" {{ $perangkat->jabatan == $jabatan ? 'selected' : '' }}>
                                {{ $jabatan }}
                            </option>
                        @endforeach
                    </select>
                    @error('jabatan')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
            </div>
        </div>

        <!-- Input Foto -->
        <div class="mb-3">
            <label for="foto" class="form-label">Foto Profil</label>
            
            <!-- Tampilkan foto saat ini jika ada -->
            @if($perangkat->foto)
                <div class="mb-2">
                    <img src="{{ Storage::url($perangkat->foto) }}" alt="Foto Profil" class="img-thumbnail" style="max-width: 150px; max-height: 150px;">
                    <br>
                    <small>Foto saat ini</small>
                </div>
            @else
                <!-- Tampilkan avatar jika tidak ada foto -->
                <div class="mb-2">
                    @php
                        $nama = $perangkat->warga->nama ?? 'Perangkat';
                        $names = explode(' ', $nama);
                        $initials = '';
                        foreach ($names as $name) {
                            $initials .= strtoupper(substr($name, 0, 1));
                        }
                        $initials = substr($initials, 0, 2);
                    @endphp
                    <div class="bg-primary text-white rounded-circle d-inline-flex align-items-center justify-content-center"
                         style="width: 80px; height: 80px; font-weight: bold; font-size: 20px;">
                        {{ $initials }}
                    </div>
                    <br>
                    <small>Avatar saat ini</small>
                </div>
            @endif
            
            <input type="file" class="form-control" id="foto" name="foto" accept="image/*">
            <div class="form-text">Format: JPEG, PNG, JPG, GIF. Maksimal 2MB. Kosongkan jika tidak ingin mengubah foto.</div>
            @error('foto')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="row">
            <div class="col-md-6">
                <div class="mb-3">
                    <label for="nip" class="form-label">NIP</label>
                    <input type="text" name="nip" id="nip" class="form-control" value="{{ old('nip', $perangkat->nip) }}" placeholder="Masukkan NIP">
                    @error('nip')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            
            <div class="col-md-6">
                <div class="mb-3">
                    <label for="kontak" class="form-label">Kontak</label>
                    <input type="text" name="kontak" id="kontak" class="form-control" value="{{ old('kontak', $perangkat->kontak) }}" placeholder="Masukkan nomor kontak">
                    @error('kontak')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-6">
                <div class="mb-3">
                    <label for="periode_mulai" class="form-label">Periode Mulai</label>
                    <input type="date" name="periode_mulai" id="periode_mulai" class="form-control" value="{{ old('periode_mulai', $perangkat->periode_mulai) }}">
                    @error('periode_mulai')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            
            <div class="col-md-6">
                <div class="mb-3">
                    <label for="periode_selesai" class="form-label">Periode Selesai</label>
                    <input type="date" name="periode_selesai" id="periode_selesai" class="form-control" value="{{ old('periode_selesai', $perangkat->periode_selesai) }}">
                    @error('periode_selesai')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
            </div>
        </div>

        <div class="d-flex gap-2">
            <button type="submit" class="btn btn-primary">Update</button>
            <a href="{{ route('perangkat.index') }}" class="btn btn-secondary">Batal</a>
        </div>
    </form>
</div>
@endsection