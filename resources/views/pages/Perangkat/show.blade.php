@extends('layouts.app')

@section('title', 'Detail Perangkat Desa')

@section('content')
<div class="container mt-4">

    <div class="card shadow-sm border-0">
        <div class="card-header bg-primary text-white">
            <h5 class="mb-0">Detail Perangkat Desa</h5>
        </div>

        <div class="card-body">

            <div class="row">

                {{-- FOTO --}}
                <div class="col-md-4 text-center mb-3">
                    @if($perangkat->foto)
                        <img src="{{ asset('storage/'.$perangkat->foto) }}"
                             class="img-fluid rounded shadow"
                             style="max-height: 300px; object-fit: cover;">
                    @else
                        <img src="{{ asset('images/default-user.png') }}"
                             class="img-fluid rounded shadow"
                             style="max-height: 300px; object-fit: cover;">
                    @endif
                </div>

                {{-- DATA --}}
                <div class="col-md-8">
                    <table class="table table-bordered">

                        <tr>
                            <th width="30%">Nama</th>
                            <td>{{ $perangkat->warga->nama ?? '-' }}</td>
                        </tr>

                        <tr>
                            <th>NIK</th>
                            <td>{{ $perangkat->warga->nik ?? '-' }}</td>
                        </tr>

                        <tr>
                            <th>Jabatan</th>
                            <td>
                                <span class="badge bg-success">
                                    {{ $perangkat->jabatan }}
                                </span>
                            </td>
                        </tr>

                        <tr>
                            <th>NIP</th>
                            <td>{{ $perangkat->nip ?? '-' }}</td>
                        </tr>

                        <tr>
                            <th>Kontak</th>
                            <td>{{ $perangkat->kontak ?? '-' }}</td>
                        </tr>

                        <tr>
                            <th>Periode</th>
                            <td>
                                {{ $perangkat->periode_mulai ?? '-' }}
                                —
                                {{ $perangkat->periode_selesai ?? 'Sekarang' }}
                            </td>
                        </tr>

                        <tr>
                            <th>Alamat</th>
                            <td>{{ $perangkat->warga->alamat ?? '-' }}</td>
                        </tr>

                        <tr>
                            <th>Jenis Kelamin</th>
                            <td>{{ $perangkat->warga->jenis_kelamin ?? '-' }}</td>
                        </tr>

                    </table>

                    <a href="{{ route('perangkat.index') }}" class="btn btn-secondary">
                        <i class="bi bi-arrow-left"></i> Kembali
                    </a>

                    <a href="{{ route('perangkat.edit', $perangkat->id) }}" class="btn btn-warning">
                        <i class="bi bi-pencil"></i> Edit
                    </a>

                </div>
            </div>

        </div>
    </div>

</div>
@endsection
