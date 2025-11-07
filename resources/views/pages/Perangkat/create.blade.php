@extends('layouts.app')

@section('content')
<div class="container">
    <h2 class="mb-4">Tambah Data Perangkat Desa</h2>

    {{-- Tampilkan error validasi --}}
    @if ($errors->any())
        <div class="alert alert-danger">
            <strong>Terjadi kesalahan:</strong>
            <ul>
                @foreach ($errors->all() as $err)
                    <li>{{ $err }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('perangkat.store') }}" method="POST">
        @csrf

        <div class="mb-3">
            <label class="form-label">Nama Warga</label>
            <select name="warga_id" class="form-control" required>
                <option value="">-- Pilih Warga --</option>
                @foreach($warga as $w)
                    <option value="{{ $w->id }}" {{ old('warga_id') == $w->id ? 'selected' : '' }}>
                        {{ $w->nama }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label class="form-label">Jabatan</label>
            <input type="text" name="jabatan" value="{{ old('jabatan') }}" class="form-control" required>
        </div>

        <div class="mb-3">
            <label class="form-label">NIP</label>
            <input type="text" name="nip" value="{{ old('nip') }}" class="form-control">
        </div>

        <div class="mb-3">
            <label class="form-label">Kontak</label>
            <input type="text" name="kontak" value="{{ old('kontak') }}" class="form-control">
        </div>

        <div class="mb-3">
            <label class="form-label">Periode Mulai</label>
            <input type="date" name="periode_mulai" value="{{ old('periode_mulai') }}" class="form-control">
        </div>

        <div class="mb-3">
            <label class="form-label">Periode Selesai</label>
            <input type="date" name="periode_selesai" value="{{ old('periode_selesai') }}" class="form-control">
        </div>

        <div class="d-flex gap-2">
            <button type="submit" class="btn btn-success">Simpan</button>
            <a href="{{ route('perangkat.index') }}" class="btn btn-secondary">Kembali</a>
        </div>
    </form>
</div>
@endsection
