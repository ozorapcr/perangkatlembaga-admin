@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow mb-4">
                <div class="card-header py-3 d-flex justify-content-between align-items-center">
                    <h6 class="m-0 font-weight-bold text-primary">Tambah Data Lembaga Desa</h6>
                    <a href="{{ route('lembaga.index') }}" class="btn btn-secondary btn-sm">
                        <i class="fas fa-arrow-left"></i> Kembali
                    </a>
                </div>
                <div class="card-body">
                    @if($errors->any())
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <i class="fas fa-exclamation-triangle me-2"></i>
                            <strong>Terjadi kesalahan:</strong>
                            <ul class="mb-0 mt-1">
                                @foreach($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif

                    <form action="{{ route('lembaga.store') }}" method="POST">
                        @csrf
                        
                        <div class="row mb-3">
                            <div class="col-md-12">
                                <label for="nama_lembaga" class="form-label small fw-bold">
                                    Nama Lembaga <span class="text-danger">*</span>
                                </label>
                                <input type="text" name="nama_lembaga" id="nama_lembaga" 
                                       class="form-control form-control-sm @error('nama_lembaga') is-invalid @enderror"
                                       value="{{ old('nama_lembaga') }}" 
                                       required 
                                       maxlength="100"
                                       placeholder="Contoh: Badan Permusyawaratan Desa, LPMD, PKK">
                                @error('nama_lembaga')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                                <small class="form-text text-muted">
                                    Maksimal 100 karakter. Nama harus unik.
                                </small>
                            </div>
                        </div>
                        
                        <div class="row mb-3">
                            <div class="col-md-12">
                                <label for="deskripsi" class="form-label small fw-bold">Deskripsi</label>
                                <textarea name="deskripsi" id="deskripsi" 
                                          class="form-control form-control-sm @error('deskripsi') is-invalid @enderror"
                                          rows="4" 
                                          placeholder="Masukkan deskripsi tentang lembaga ini">{{ old('deskripsi') }}</textarea>
                                @error('deskripsi')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                                <small class="form-text text-muted">
                                    Deskripsi singkat tentang tugas, fungsi, dan kegiatan lembaga
                                </small>
                            </div>
                        </div>
                        
                        <div class="row mb-3">
                            <div class="col-md-12">
                                <label for="kontak" class="form-label small fw-bold">Kontak</label>
                                <input type="text" name="kontak" id="kontak" 
                                       class="form-control form-control-sm @error('kontak') is-invalid @enderror"
                                       value="{{ old('kontak') }}" 
                                       maxlength="50"
                                       placeholder="Contoh: 0812-3456-7890, email@lembaga.desa">
                                @error('kontak')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                                <small class="form-text text-muted">
                                    Nomor telepon, email, atau kontak lain yang bisa dihubungi
                                </small>
                            </div>
                        </div>
                        
                        <div class="row">
                            <div class="col-md-12">
                                <div class="d-flex justify-content-end gap-2">
                                    <button type="reset" class="btn btn-secondary btn-sm">
                                        <i class="fas fa-undo"></i> Reset
                                    </button>
                                    <button type="submit" class="btn btn-primary btn-sm">
                                        <i class="fas fa-save"></i> Simpan
                                    </button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
.card {
    border: 1px solid #e3e6f0;
    border-radius: 0.375rem;
}
.card-header {
    border-bottom: 1px solid #e3e6f0;
    background-color: #f8f9fc;
}
.form-control-sm {
    font-size: 0.875rem;
}
</style>
@endsection