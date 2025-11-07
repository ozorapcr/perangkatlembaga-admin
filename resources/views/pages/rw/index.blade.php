@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h2>Daftar RW</h2>
    <a href="{{ route('rw.create') }}" class="btn btn-primary mb-3">Tambah RW</a>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nomor RW</th>
                <th>Ketua RW Warga ID</th>
                <th>Keterangan</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($rws as $rw)
            <tr>
                <td>{{ $rw->id }}</td>
                <td>{{ $rw->nomorRw }}</td>
                <td>{{ $rw->ketuaRwWargaId }}</td>
                <td>{{ $rw->keterangan }}</td>
                <td>
                    <a href="{{ route('rw.edit', $rw->id) }}" class="btn btn-warning btn-sm">Edit</a>
                    <form action="{{ route('rw.destroy', $rw->id) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button onclick="return confirm('Yakin ingin hapus?')" class="btn btn-danger btn-sm">Hapus</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
