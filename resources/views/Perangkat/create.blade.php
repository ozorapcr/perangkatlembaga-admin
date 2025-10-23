@extends('layouts.app')

@section('content')
<div class="card">
    <div class="card-header">Tambah Perangkat Desa</div>
    <div class="card-body">
        <form action="{{ route('perangkat.store') }}" method="POST">
            @csrf

            <div class="mb-3">
                <label for="warga_id" class="form-label">Warga ID</label>
                <input type="number" name="warga_id" class="form-control" required>
            </div>

            <div class="mb-3">
                <label for="jabatan" class="form-label">Jabatan</label>
                <input type="text" name="jabatan" class="form-control" required>
            </div>

            <div class="mb-3">
                <label for="nip" class="form-label">NIP</label>
                <input type="text" name="nip" class="form-control">
            </div>

            <div class="mb-3">
                <label for="kontak" class="form-label">Kontak</label>
                <input type="text" name="kontak" class="form-control">
            </div>

            <div class="mb-3">
                <label for="periode_mulai" class="form-label">Periode Mulai</label>
                <input type="date" name="periode_mulai" class="form-control">
            </div>

            <div class="mb-3">
                <label for="periode_selesai" class="form-label">Periode Selesai</label>
                <input type="date" name="periode_selesai" class="form-control">
            </div>

            <button type="submit" class="btn btn-primary">Simpan</button>
        </form>
    </div>
</div>
@endsection
