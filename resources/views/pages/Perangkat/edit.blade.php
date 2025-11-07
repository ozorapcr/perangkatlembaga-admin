@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Edit Data Perangkat Desa</h2>

    <form action="{{ route('perangkat.update', $perangkat->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label>Nama Warga</label>
            <select name="warga_id" class="form-control" required>
                @foreach($warga as $w)
                    <option value="{{ $w->id }}" {{ $perangkat->warga_id == $w->id ? 'selected' : '' }}>
                        {{ $w->nama }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label>Jabatan</label>
            <input type="text" name="jabatan" value="{{ $perangkat->jabatan }}" class="form-control" required>
        </div>
        <div class="mb-3">
            <label>NIP</label>
            <input type="text" name="nip" value="{{ $perangkat->nip }}" class="form-control">
        </div>
        <div class="mb-3">
            <label>Kontak</label>
            <input type="text" name="kontak" value="{{ $perangkat->kontak }}" class="form-control">
        </div>
        <div class="mb-3">
            <label>Periode Mulai</label>
            <input type="date" name="periode_mulai" value="{{ $perangkat->periode_mulai }}" class="form-control">
        </div>
        <div class="mb-3">
            <label>Periode Selesai</label>
            <input type="date" name="periode_selesai" value="{{ $perangkat->periode_selesai }}" class="form-control">
        </div>

        <button type="submit" class="btn btn-success">Perbarui</button>
        <a href="{{ route('perangkat.index') }}" class="btn btn-secondary">Kembali</a>
    </form>
</div>
@endsection
