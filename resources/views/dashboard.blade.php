@extends('layouts.app')

@section('content')
<div class="card shadow-sm">
    <div class="card-body">
        <h5>Selamat Datang di Dashboard Sistem RW</h5>
        <p class="text-muted">Berikut adalah ringkasan data saat ini:</p>
        <div class="row mt-4">
            <div class="col-md-4">
                <div class="card text-center border-0 shadow-sm">
                    <div class="card-body">
                        <h1>{{ $jumlahPerangkat }}</h1>
                        <p class="text-muted mb-0">Perangkat Desa Terdaftar</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
