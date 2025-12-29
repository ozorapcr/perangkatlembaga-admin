# Buat file create.blade.php
cat > resources/views/anggota-lembaga/create.blade.php << 'EOF'
@extends('layouts.app')

@section('title', 'Tambah Anggota Lembaga')

@section('content')
<div class="container-fluid">
    <div class="card">
        <div class="card-header">
            <h5 class="card-title">Tambah Anggota Lembaga</h5>
        </div>
        <div class="card-body">
            <form action="{{ route('anggota-lembaga.store') }}" method="POST">
                @csrf
                <div class="mb-3">
                    <label for="lembaga_id" class="form-label">Lembaga</label>
                    <select name="lembaga_id" id="lembaga_id" class="form-control @error('lembaga_id') is-invalid @enderror" required>
                        <option value="">Pilih Lembaga</option>
                        @foreach($lembagas as $lembaga)
                            <option value="{{ $lembaga->lembaga_id }}" {{ old('lembaga_id') == $lembaga->lembaga_id ? 'selected' : '' }}>
                                {{ $lembaga->nama_lembaga }}
                            </option>
                        @endforeach
                    </select>
                    @error('lembaga_id')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="warga_id" class="form-label">Warga</label>
                    <select name="warga_id" id="warga_id" class="form-control @error('warga_id') is-invalid @enderror" required>
                        <option value="">Pilih Warga</option>
                        @foreach($wargas as $warga)
                            <option value="{{ $warga->id }}" {{ old('warga_id') == $warga->id ? 'selected' : '' }}>
                                {{ $warga->nama }}
                            </option>
                        @endforeach
                    </select>
                    @error('warga_id')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="jabatan_id" class="form-label">Jabatan</label>
                    <select name="jabatan_id" id="jabatan_id" class="form-control @error('jabatan_id') is-invalid @enderror" required>
                        <option value="">Pilih Jabatan</option>
                        @foreach($jabatans as $jabatan)
                            <option value="{{ $jabatan->jabatan_id }}" {{ old('jabatan_id') == $jabatan->jabatan_id ? 'selected' : '' }}>
                                {{ $jabatan->nama_jabatan }}
                            </option>
                        @endforeach
                    </select>
                    @error('jabatan_id')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="tgl_mulai" class="form-label">Tanggal Mulai</label>
                    <input type="date" name="tgl_mulai" id="tgl_mulai" class="form-control @error('tgl_mulai') is-invalid @enderror" value="{{ old('tgl_mulai') }}" required>
                    @error('tgl_mulai')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="tgl_selesai" class="form-label">Tanggal Selesai (Opsional)</label>
                    <input type="date" name="tgl_selesai" id="tgl_selesai" class="form-control @error('tgl_selesai') is-invalid @enderror" value="{{ old('tgl_selesai') }}">
                    <small class="text-muted">Kosongkan jika masih aktif</small>
                    @error('tgl_selesai')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="d-flex justify-content-end">
                    <a href="{{ route('anggota-lembaga.index') }}" class="btn btn-secondary me-2">Batal</a>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
EOF