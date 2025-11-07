@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h3>Edit Warga</h3>

    <form action="{{ route('warga.update', $warga->id) }}" method="POST">
        @csrf @method('PUT')
        <div class="mb-3">
            <label>Nama</label>
            <input type="text" name="nama" class="form-control" value="{{ $warga->nama }}" required>
        </div>
        <div class="mb-3">
            <label>NIK</label>
            <input type="text" name="nik" class="form-control" value="{{ $warga->nik }}">
        </div>
        <div class="mb-3">
            <label>No HP</label>
            <input type="text" name="no_hp" class="form-control" value="{{ $warga->no_hp }}">
        </div>
        <div class="mb-3">
            <label>Alamat</label>
            <textarea name="alamat" class="form-control">{{ $warga->alamat }}</textarea>
        </div>
        <button type="submit" class="btn btn-primary">Perbarui</button>
        <a href="{{ route('warga.index') }}" class="btn btn-secondary">Kembali</a>
    </form>
</div>
@endsection
