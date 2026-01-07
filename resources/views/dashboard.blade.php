@extends('layouts.app')

@section('content')
    <div class="container mt-4">

        <!-- Welcome Card -->
        <div class="card shadow-sm mb-4">
            <div class="card-body text-center">
                <h3 class="mb-2">Selamat Datang di Dashboard Sistem RW</h3>
                <p class="text-muted">Ringkasan data dan informasi terkini desa</p>
            </div>
        </div>

        <!-- Info Cards -->
        <div class="row g-3 mb-4">
            <div class="col-md-4 col-lg-2">
                <div class="card border-0 shadow-sm text-center p-3">
                    <div class="card-body">
                        <h2 class="text-primary">{{ $jumlahPerangkat }}</h2>
                        <p class="text-muted">Perangkat Desa</p>
                    </div>
                </div>
            </div>

            <div class="col-md-4 col-lg-2">
                <div class="card border-0 shadow-sm text-center p-3">
                    <div class="card-body">
                        <h2 class="text-success">{{ $jumlahWarga }}</h2>
                        <p class="text-muted">Warga Terdaftar</p>
                    </div>
                </div>
            </div>

            <div class="col-md-4 col-lg-2">
                <div class="card border-0 shadow-sm text-center p-3">
                    <div class="card-body">
                        <h2 class="text-warning">{{ $jumlahLembaga }}</h2>
                        <p class="text-muted">Jumlah Lembaga</p>
                    </div>
                </div>
            </div>

            <div class="col-md-4 col-lg-2">
                <div class="card border-0 shadow-sm text-center p-3">
                    <div class="card-body">
                        <h2 class="text-info">{{ $jumlahJabatanLembaga }}</h2>
                        <p class="text-muted">Jabatan Lembaga</p>
                    </div>
                </div>
            </div>

            <div class="col-md-4 col-lg-2">
                <div class="card border-0 shadow-sm text-center p-3">
                    <div class="card-body">
                        <h2 class="text-danger">{{ $jumlahRt }}</h2>
                        <p class="text-muted">Jumlah RT</p>
                    </div>
                </div>
            </div>

            <div class="col-md-4 col-lg-2">
                <div class="card border-0 shadow-sm text-center p-3">
                    <div class="card-body">
                        <h2 class="text-secondary">{{ $jumlahRw }}</h2>
                        <p class="text-muted">Jumlah RW</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Slideshow / Carousel -->
        <div class="container mb-5"> <!-- Carousel mengikuti lebar container -->
            <div id="dashboardCarousel" class="carousel slide shadow-sm rounded" data-bs-ride="carousel">
                <div class="carousel-inner" style="height: 300px;"> <!-- atur tinggi sesuai kebutuhan -->
                    <div class="carousel-item active">
                        <img src="{{ asset('assets/img/gambar1.png') }}"
                            class="d-block w-100 h-100 object-fit-cover rounded" alt="Slide 1">
                    </div>
                    <div class="carousel-item">
                        <img src="{{ asset('assets/img/gambar2.png') }}"
                            class="d-block w-100 h-100 object-fit-cover rounded" alt="Slide 1">
                    </div>
                    <div class="carousel-item">
                        <img src="{{ asset('assets/img/gambar3.png') }}"
                            class="d-block w-100 h-100 object-fit-cover rounded" alt="Slide 1">
                    </div>
                </div>

                <button class="carousel-control-prev" type="button" data-bs-target="#dashboardCarousel"
                    data-bs-slide="prev">
                    <span class="carousel-control-prev-icon"></span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#dashboardCarousel"
                    data-bs-slide="next">
                    <span class="carousel-control-next-icon"></span>
                </button>
            </div>
        </div>

        <style>
            #dashboardCarousel .carousel-inner img {
                object-fit: cover;
                /* menjaga proporsi gambar */
                height: 100%;
                /* mengikuti tinggi carousel */
                width: 20%;
            }
        </style>


        <!-- Additional Info Section -->
        <div class="card shadow-sm mb-4">
            <div class="card-body">
                <h5>Info Terbaru</h5>
                <p class="text-muted">Semua data diperbarui secara real-time sesuai kegiatan desa dan administrasi RW/RT.
                </p>
            </div>
        </div>

    </div>
@endsection
