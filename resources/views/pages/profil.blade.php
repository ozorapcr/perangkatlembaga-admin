@extends('layouts.app')

@section('content')
<div class="container my-5">
    <h3 class="text-center mb-5 fw-bold">Profil Pengembang</h3>

    <div class="card shadow-lg rounded-4 p-4 profile-card-horizontal">
        <div class="row align-items-center">

            <!-- Foto Kiri -->
            <div class="col-md-4 text-center mb-3 mb-md-0">
                <img src="{{ asset('assets/img/zora 1.jpeg') }}" alt="Foto Pengembang" class="profile-img-horizontal">
            </div>

            <!-- Info Kanan -->
            <div class="col-md-8">
                <h4 class="fw-bold mb-2">Ozora Feona Surya</h4>
                <p class="text-muted mb-1"><strong>NIM:</strong> 2457301118</p>
                <p class="text-muted mb-1"><strong>Prodi:</strong> Teknologi Informasi</p>
                <p class="text-muted mb-1"><strong>Umur:</strong> 19 Tahun</p>
                <p class="text-muted mb-1"><strong>Email:</strong> ozora24si@mahasiswa.pcr.ac.id</p>
                <p class="text-muted mb-1"><strong>No. HP:</strong> +62 82286304303</p>
                <p class="text-muted mb-1"><strong>Universitas:</strong> Politeknik Caltex Riau</p>

                <!-- Sosial Media -->
                <div class="d-flex gap-3 mt-3">
                    <a href="www.linkedin.com/in/ozorafeonasurya" target="_blank" class="social-icon linkedin" title="LinkedIn">
                        <i class="bi bi-linkedin"></i>
                    </a>
                    <a href="https://github.com/ozorapcr" target="_blank" class="social-icon github" title="GitHub">
                        <i class="bi bi-github"></i>
                    </a>
                    <a href="https://www.instagram.com/ozorafeonasrya._" target="_blank" class="social-icon instagram" title="Instagram">
                        <i class="bi bi-instagram"></i>
                    </a>
                    <a href="https://wa.me/6282286304303" target="_blank" class="social-icon whatsapp" title="WhatsApp">
                        <i class="bi bi-whatsapp"></i>
                    </a>
                </div>
            </div>

        </div>
    </div>
</div>

<style>
/* Card horizontal modern */
.profile-card-horizontal {
    background: rgba(255,255,255,0.85);
    backdrop-filter: blur(10px);
    border-radius: 25px;
    transition: transform 0.3s, box-shadow 0.3s;
}

.profile-card-horizontal:hover {
    transform: translateY(-8px);
    box-shadow: 0 20px 40px rgba(0,0,0,0.2);
}

/* Foto bulat kiri */
.profile-img-horizontal {
    width: 160px;
    height: 160px;
    border-radius: 50%;
    object-fit: cover;
    border: 4px solid #fff;
    transition: transform 0.3s, box-shadow 0.3s;
}

.profile-img-horizontal:hover {
    transform: scale(1.05);
    box-shadow: 0 8px 20px rgba(0,0,0,0.2);
}

/* Sosial media icons */
.social-icon {
    font-size: 1.5rem;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    width: 45px;
    height: 45px;
    border-radius: 50%;
    background-color: #f0f0f0;
    color: #333;
    transition: all 0.3s;
}

.social-icon:hover {
    transform: scale(1.2);
    color: #fff;
}

.linkedin:hover { background-color: #0a66c2; }
.github:hover { background-color: #333; }
.instagram:hover { background-color: #c13584; }
.whatsapp:hover { background-color: #25d366; }

/* Responsive untuk mobile */
@media(max-width: 576px){
    .profile-card-horizontal {
        text-align: center;
    }
    .profile-card-horizontal .col-md-8 {
        margin-top: 15px;
    }
    .profile-card-horizontal .d-flex {
        justify-content: center;
    }
}
</style>
@endsection
