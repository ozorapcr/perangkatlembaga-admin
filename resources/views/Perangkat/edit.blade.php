@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <div class="card shadow rounded border-0">
        <div class="card-header bg-primary text-white">
            <h4 class="mb-0">Edit Data Perangkat Desa</h4>
        </div>
        <div class="card-body bg-light">
            <form action="{{ route('perangkat.update', ['perangkat' => $perangkat->perangkat_id]) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label for="warga_id" class="form-label">Warga ID</label>
                    <input type="number" class="form-control" id="warga_id" name="warga_id" 
                        value="{{ old('warga_id', $perangkat->warga_id) }}" required>
                </div>

                <div class="mb-3">
                    <label for="jabatan" class="form-label">Jabatan</label>
                    <input type="text" class="form-control" id="jabatan" name="jabatan" 
                        value="{{ old('jabatan', $perangkat->jabatan) }}" required>
                </div>

                <div class="mb-3">
                    <label for="nip" class="form-label">NIP</label>
                    <input type="text" class="form-control" id="nip" name="nip" 
                        value="{{ old('nip', $perangkat->nip) }}">
                </div>

                <div class="mb-3">
                    <label for="kontak" class="form-label">Kontak</label>
                    <input type="text" class="form-control" id="kontak" name="kontak" 
                        value="{{ old('kontak', $perangkat->kontak) }}">
                </div>

                <div class="mb-3">
                    <label for="periode_mulai" class="form-label">Periode Mulai</label>
                    <input type="date" class="form-control" id="periode_mulai" name="periode_mulai" 
                        value="{{ old('periode_mulai', $perangkat->periode_mulai) }}">
                </div>

                <div class="mb-3">
                    <label for="periode_selesai" class="form-label">Periode Selesai</label>
                    <input type="date" class="form-control" id="periode_selesai" name="periode_selesai" 
                        value="{{ old('periode_selesai', $perangkat->periode_selesai) }}">
                </div>

                <div class="d-flex justify-content-between">
                    <a href="{{ route('perangkat.index') }}" class="btn btn-secondary">
                        <i class="bi bi-arrow-left-circle"></i> Kembali
                    </a>
                    <button type="submit" class="btn btn-success">
                        <i class="bi bi-check-circle"></i> Update
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
    