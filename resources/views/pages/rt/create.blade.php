@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h4 class="mb-0">Tambah Data RT</h4>
                </div>
                <div class="card-body">
                    <form action="{{ route('rt.store') }}" method="POST">
                        @csrf
                        
                        <div class="mb-3">
                            <label for="rw_id" class="form-label">RW <span class="text-danger">*</span></label>
                            <select name="rw_id" id="rw_id" class="form-control @error('rw_id') is-invalid @enderror" required>
                                <option value="">Pilih RW</option>
                                @foreach($rws as $rw)
                                    <option value="{{ $rw->id }}" {{ old('rw_id') == $rw->id ? 'selected' : '' }}>
                                        RW {{ $rw->nomorRw }}
                                    </option>
                                @endforeach
                            </select>
                            @error('rw_id')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <div class="mb-3">
                            <label for="nomor_rt" class="form-label">Nomor RT <span class="text-danger">*</span></label>
                            <input type="text" name="nomor_rt" id="nomor_rt" 
                                   class="form-control @error('nomor_rt') is-invalid @enderror"
                                   value="{{ old('nomor_rt') }}" 
                                   required 
                                   maxlength="3"
                                   placeholder="Contoh: 001, 002">
                            @error('nomor_rt')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            <small class="form-text text-muted">Maksimal 3 karakter angka</small>
                        </div>
                        
                        <div class="mb-3">
                            <label for="ketua_rt_warga_id" class="form-label">Ketua RT (Warga ID)</label>
                            <input type="number" name="ketua_rt_warga_id" id="ketua_rt_warga_id" 
                                   class="form-control @error('ketua_rt_warga_id') is-invalid @enderror"
                                   value="{{ old('ketua_rt_warga_id') }}" 
                                   min="1"
                                   placeholder="Masukkan ID warga">
                            @error('ketua_rt_warga_id')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            <small class="form-text text-muted">
                                Kosongkan jika belum ada ketua RT
                            </small>
                        </div>
                        
                        <div class="mb-3">
                            <label for="keterangan" class="form-label">Keterangan</label>
                            <textarea name="keterangan" id="keterangan" 
                                      class="form-control @error('keterangan') is-invalid @enderror"
                                      rows="3" 
                                      placeholder="Masukkan keterangan tambahan">{{ old('keterangan') }}</textarea>
                            @error('keterangan')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <div class="d-flex justify-content-between">
                            <a href="{{ route('rt.index') }}" class="btn btn-secondary">
                                <i class="fas fa-arrow-left"></i> Kembali
                            </a>
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-save"></i> Simpan
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection