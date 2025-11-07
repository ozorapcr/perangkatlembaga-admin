@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h2>Edit Data RW</h2>
    <form action="{{ route('rw.update', $rw->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label>Nomor RW</label>
            <input type="text" name="nomorRw" value="{{ $rw->nomorRw }}" class="form-control" required>
        </div>
        <div class="mb-3">
            <label>Ketua RW Warga ID</label>
            <input type="number" name="ketuaRwWargaId" value="{{ $rw->ketuaRwWargaId }}" class="form-control">
        </div>
        <div class="mb-3">
            <label>Keterangan</label>
            <textarea name="keterangan" class="form-control">{{ $rw->keterangan }}</textarea>
        </div>
        <button type="submit" class="btn btn-success">Update</button>
        <a href="{{ route('rw.index') }}" class="btn btn-secondary">Kembali</a>
    </form>
</div>
@endsection
