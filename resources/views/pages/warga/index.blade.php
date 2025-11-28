@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h3 class="card-title mb-0">Daftar Warga</h3>
                    <a href="{{ route('warga.create') }}" class="btn btn-primary">+ Tambah Warga</a>
                </div>
                <div class="card-body">
                    @if(session('success'))
                        <div class="alert alert-success">{{ session('success') }}</div>
                    @endif

                    <!-- Form Filter dan Search -->
                    <form method="GET" action="{{ route('warga.index') }}" class="mb-4">
                        <div class="row">
                            <!-- Filter Alamat -->
                            <div class="col-md-3">
                                <label for="alamat" class="form-label">Filter Alamat:</label>
                                <select name="alamat" id="alamat" class="form-select" onchange="this.form.submit()">
                                    <option value="">Semua Alamat</option>
                                    <option value="Dusun Krajan" {{ request('alamat') == 'Dusun Krajan' ? 'selected' : '' }}>Dusun Krajan</option>
                                    <option value="Dusun Sukorejo" {{ request('alamat') == 'Dusun Sukorejo' ? 'selected' : '' }}>Dusun Sukorejo</option>
                                    <option value="Dusun Sumberejo" {{ request('alamat') == 'Dusun Sumberejo' ? 'selected' : '' }}>Dusun Sumberejo</option>
                                    <option value="Dusun Sidomulyo" {{ request('alamat') == 'Dusun Sidomulyo' ? 'selected' : '' }}>Dusun Sidomulyo</option>
                                    <!-- Tambahkan opsi alamat lainnya sesuai kebutuhan -->
                                </select>
                            </div>

                            <!-- Search -->
                            <div class="col-md-4">
                                <label for="search" class="form-label">Search:</label>
                                <div class="input-group">
                                    <input type="text" name="search" class="form-control" id="exampleInputIconRight" 
                                           value="{{ request('search') }}" placeholder="Search nama, NIK, alamat, no HP..." 
                                           aria-label="Search">
                                    <button type="submit" class="input-group-text" id="basic-addon2">
                                        <svg class="icon icon-xxs" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                            <path fill-rule="evenodd" d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z" clip-rule="evenodd"></path>
                                        </svg>
                                    </button>
                                    @if(request('search'))
                                        <a href="{{ request()->fullUrlWithQuery(['search'=> null]) }}" class="btn btn-outline-secondary ms-2" id="clear-search">Clear</a>
                                    @endif
                                </div>
                            </div>

                            <!-- Reset Button -->
                            <div class="col-md-2 d-flex align-items-end">
                                <a href="{{ route('warga.index') }}" class="btn btn-secondary">Reset All</a>
                            </div>
                        </div>
                    </form>

                    <div class="table-responsive">
                        <table class="table table-bordered table-striped">
                            <thead class="table-dark">
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
                                                @csrf 
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Yakin hapus data ini?')">Hapus</button>
                                            </form>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="6" class="text-center">
                                            @if(request('alamat') || request('search'))
                                                Tidak ada data warga yang sesuai dengan filter
                                            @else
                                                Belum ada data
                                            @endif
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    <div>
                        {{ $warga->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection