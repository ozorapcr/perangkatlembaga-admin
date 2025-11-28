@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Tambah Perangkat Desa</h2>

    <form action="{{ route('perangkat.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        
        <div class="row">
            <div class="col-md-6">
                <div class="mb-3">
                    <label for="warga_id" class="form-label">Nama Warga *</label>
                    <select name="warga_id" id="warga_id" class="form-select" required>
                        <option value="">Pilih Warga</option>
                        @foreach($warga as $w)
                            <option value="{{ $w->id }}" {{ old('warga_id') == $w->id ? 'selected' : '' }}>
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
                            <option value="{{ $jabatan }}" {{ old('jabatan') == $jabatan ? 'selected' : '' }}>
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
            <input type="file" class="form-control" id="foto" name="foto" accept="image/*">
            <div class="form-text">Format: JPEG, PNG, JPG, GIF. Maksimal 2MB.</div>
            @error('foto')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="row">
            <div class="col-md-6">
                <div class="mb-3">
                    <label for="nip" class="form-label">NIP</label>
                    <input type="text" name="nip" id="nip" class="form-control" value="{{ old('nip') }}" placeholder="Masukkan NIP">
                    @error('nip')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            
            <div class="col-md-6">
                <div class="mb-3">
                    <label for="kontak" class="form-label">Kontak</label>
                    <input type="text" name="kontak" id="kontak" class="form-control" value="{{ old('kontak') }}" placeholder="Masukkan nomor kontak">
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
                    <input type="date" name="periode_mulai" id="periode_mulai" class="form-control" value="{{ old('periode_mulai') }}">
                    @error('periode_mulai')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            
            <div class="col-md-6">
                <div class="mb-3">
                    <label for="periode_selesai" class="form-label">Periode Selesai</label>
                    <input type="date" name="periode_selesai" id="periode_selesai" class="form-control" value="{{ old('periode_selesai') }}">
                    @error('periode_selesai')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
            </div>
        </div>

        <div class="d-flex gap-2">
            <button type="submit" class="btn btn-primary">Simpan</button>
            <a href="{{ route('perangkat.index') }}" class="btn btn-secondary">Batal</a>
        </div>
    </form>
</div>
@endsection