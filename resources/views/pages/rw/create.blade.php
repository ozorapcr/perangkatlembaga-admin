@extends('layouts.app')

@section('content')
    <div class="container mt-4">

        <h2>Tambah RW</h2>

        <form action="{{ route('rw.store') }}" method="POST">
            @csrf

            <div class="mb-3">
                <label class="form-label">Nomor RW</label>
                <input type="text" name="nomorRw" value="{{ old('nomorRw') }}"
                    class="form-control @error('nomorRw') is-invalid @enderror" required>

                @error('nomorRw')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>


            <div class="mb-3">
                <label class="form-label">Ketua RW</label>

                <select name="ketuaRwWargaId" class="form-control @error('ketuaRwWargaId') is-invalid @enderror">

                    <option value="">— Pilih Ketua RW —</option>

                    @foreach ($wargas as $warga)
                        <option value="{{ $warga->id }}" {{ old('ketuaRwWargaId') == $warga->id ? 'selected' : '' }}>
                            {{ $warga->nama }} ({{ $warga->nik ?? 'NIK Tidak Ada' }})
                        </option>
                    @endforeach
                </select>

                @error('ketuaRwWargaId')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>


            <div class="mb-3">
                <label class="form-label">Keterangan</label>
                <textarea name="keterangan" class="form-control @error('keterangan') is-invalid @enderror">{{ old('keterangan') }}</textarea>

                @error('keterangan')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>


            <button type="submit" class="btn btn-success">Simpan</button>
            <a href="{{ route('rw.index') }}" class="btn btn-secondary">Kembali</a>

        </form>

    </div>
@endsection
