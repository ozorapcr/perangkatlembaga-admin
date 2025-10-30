@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h2>Tambah RW</h2>
    <form action="{{ route('rw.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label>Nomor RW</label>
            <input type="text" name="nomorRw" class="form-control" required>
        </div>
        <div class="mb-3">
            <label>Ketua RW Warga ID</label>
            <input type="number" name="ketuaRwWargaId" class="form-control">
        </div>
        <div class="mb-3">
            <label>Keterangan</label>
            <textarea name="keterangan" class="form-control"></textarea>
        </div>
        <button type="submit" class="btn btn-success">Simpan</button>
        <a href="{{ route('rw.index') }}" class="btn btn-secondary">Kembali</a>
    </form>
</div>
@endsection
