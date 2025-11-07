@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Data Perangkat Desa</h2>
    <a href="{{ route('perangkat.create') }}" class="btn btn-primary mb-3">Tambah Perangkat</a>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>No</th>
                <th>Nama Warga</th>
                <th>Jabatan</th>
                <th>NIP</th>
                <th>Kontak</th>
                <th>Periode</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($data as $i => $row)
            <tr>
                <td>{{ $i+1 }}</td>
                <td>{{ $row->warga->nama ?? '-' }}</td>
                <td>{{ $row->jabatan }}</td>
                <td>{{ $row->nip ?? '-' }}</td>
                <td>{{ $row->kontak ?? '-' }}</td>
                <td>{{ $row->periode_mulai }} - {{ $row->periode_selesai }}</td>
                <td>
                    <a href="{{ route('perangkat.edit', $row->id) }}" class="btn btn-warning btn-sm">Edit</a>
                    <form action="{{ route('perangkat.destroy', $row->id) }}" method="POST" style="display:inline-block">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Yakin hapus?')">Hapus</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
