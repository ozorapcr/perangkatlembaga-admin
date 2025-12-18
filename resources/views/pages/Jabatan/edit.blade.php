{{-- resources/views/jabatan-lembaga/edit.blade.php --}}
@extends('layouts.app')

@section('title', 'Edit Jabatan Lembaga')

@section('content')
<div class="container mt-4">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h4 class="mb-0">Edit Jabatan: {{ $jabatan_lembaga->nama_jabatan }}</h4>
                </div>
                <div class="card-body">
                    <form action="{{ route('jabatan.update', $jabatan_lembaga->jabatan_id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        
                        <div class="mb-3">
                            <label for="lembaga_id" class="form-label">Lembaga <span class="text-danger">*</span></label>
                            <select class="form-control @error('lembaga_id') is-invalid @enderror" 
                                    id="lembaga_id" name="lembaga_id" required>
                                <option value="">-- Pilih Lembaga --</option>
                                @foreach($lembagas as $lembaga)
                                    <option value="{{ $lembaga->lembaga_id }}" 
                                            {{ old('lembaga_id', $jabatan_lembaga->lembaga_id) == $lembaga->lembaga_id ? 'selected' : '' }}>
                                        {{ $lembaga->nama_lembaga }}
                                    </option>
                                @endforeach
                            </select>
                            @error('lembaga_id')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="nama_jabatan" class="form-label">Nama Jabatan <span class="text-danger">*</span></label>
                            <input type="text" class="form-control @error('nama_jabatan') is-invalid @enderror" 
                                   id="nama_jabatan" name="nama_jabatan" 
                                   value="{{ old('nama_jabatan', $jabatan_lembaga->nama_jabatan) }}" required maxlength="100">
                            @error('nama_jabatan')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="level" class="form-label">Level <span class="text-danger">*</span></label>
                            <input type="number" class="form-control @error('level') is-invalid @enderror" 
                                   id="level" name="level" 
                                   value="{{ old('level', $jabatan_lembaga->level) }}" min="1" required>
                            <div class="form-text">Semakin rendah angka, semakin tinggi level jabatan. Contoh: 1 = tertinggi.</div>
                            @error('level')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="d-flex justify-content-between">
                            <a href="{{ route('jabatan.index') }}" class="btn btn-secondary">
                                <i class="bi bi-arrow-left"></i> Kembali
                            </a>
                            <button type="submit" class="btn btn-primary">
                                <i class="bi bi-save"></i> Perbarui
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection