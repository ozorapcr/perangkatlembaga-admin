@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h3 class="mb-3">Daftar Warga</h3>

    <a href="{{ route('warga.create') }}" class="btn btn-primary mb-3">+ Tambah Warga</a>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>No</th>
                <th>Nama</th>
                <th>NIK</th>
                <th>No HP</th>
                <th>Alamat</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse($warga as $item)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $item->nama }}</td>
                    <td>{{ $item->nik }}</td>
                    <td>{{ $item->no_hp }}</td>
                    <td>{{ $item->alamat }}</td>
                    <td>
                        <a href="{{ route('warga.edit', $item->id) }}" class="btn btn-warning btn-sm">Edit</a>
                        <form action="{{ route('warga.destroy', $item->id) }}" method="POST" style="display:inline-block;">
                            @csrf @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Yakin hapus data ini?')">Hapus</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr><td colspan="6" class="text-center">Belum ada data</td></tr>
            @endforelse
        </tbody>
    </table>

    {{ $warga->links() }}
</div>
@endsection
