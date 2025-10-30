@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h3>Tambah Warga</h3>

    <form action="{{ route('warga.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label>Nama</label>
            <input type="text" name="nama" class="form-control" required>
        </div>
        <div class="mb-3">
            <label>NIK</label>
            <input type="text" name="nik" class="form-control">
        </div>
        <div class="mb-3">
            <label>No HP</label>
            <input type="text" name="no_hp" class="form-control">
        </div>
        <div class="mb-3">
            <label>Alamat</label>
            <textarea name="alamat" class="form-control"></textarea>
        </div>
        <button type="submit" class="btn btn-success">Simpan</button>
        <a href="{{ route('warga.index') }}" class="btn btn-secondary">Kembali</a>
    </form>
</div>
@endsection
