<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Sistem RW</title>

    <!-- Bootstrap & Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">

    <style>
        body {
            background: linear-gradient(to right, #e3f2fd, #fff);
            font-family: 'Segoe UI', sans-serif;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            margin: 0;
        }

        .login-card {
            display: flex;
            width: 900px;
            height: 520px;
            background: #fff;
            border-radius: 14px;
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.1);
            overflow: hidden;
        }

        /* Sisi kiri */
        .login-left {
            background-color: #3f51b5;
            color: white;
            flex: 1;
            padding: 40px;
            text-align: center;
            display: flex;
            flex-direction: column;
            justify-content: center;
        }

        .login-left img.logo {
            width: 90px;
            margin: 0 auto 20px;
        }

        .login-left h3 {
            font-weight: 700;
            margin-bottom: 10px;
        }

        .login-left p {
            font-size: 15px;
            color: #e3e3e3;
            margin-bottom: 30px;
        }

        .login-left img.ilustrasi {
            width: 70%;
            max-width: 250px;
            margin: 0 auto;
        }

        /* Sisi kanan */
        .login-right {
            flex: 1;
            padding: 50px 40px;
            display: flex;
            flex-direction: column;
            justify-content: center;
        }

        .login-right h4 {
            font-weight: 700;
            margin-bottom: 10px;
            color: #222;
        }

        .login-right p {
            color: #555;
            font-size: 14px;
            margin-bottom: 25px;
        }

        .form-control {
            border-radius: 6px;
            height: 45px;
        }

        .btn-primary {
            background-color: #3f51b5;
            border: none;
            border-radius: 6px;
            height: 45px;
            font-weight: 600;
        }

        .btn-primary:hover {
            background-color: #303f9f;
        }

        .form-check-label, .forgot-link, small {
            font-size: 13px;
        }

        .forgot-link {
            text-decoration: none;
            color: #3f51b5;
        }

        .forgot-link:hover {
            text-decoration: underline;
        }

        .footer {
            text-align: center;
            margin-top: 20px;
            color: #888;
            font-size: 13px;
        }

        @media (max-width: 768px) {
            .login-card {
                flex-direction: column;
                width: 90%;
                height: auto;
            }

            .login-left {
                padding: 30px 20px;
            }

            .login-right {
                padding: 30px 20px;
            }
        }
    </style>
</head>
<body>

<div class="login-card">
    <!-- Sisi kiri -->
    <div class="login-left">
        <img src="{{ asset('images/Logo_Lapas.png') }}" alt="Logo Lapas" class="logo">
        <h3>Selamat Datang di Sistem RW</h3>
        <p>Masuk ke akun Anda untuk mengakses semua fitur dan layanan Sistem RW.<br>Kami senang Anda kembali!</p>
        <img src="{{ asset('images/ilustrasi-login.jpg') }}" alt="Ilustrasi Login" class="ilustrasi">
    </div>

    <!-- Sisi kanan -->
    <div class="login-right">
        <h4><i class="fa-solid fa-right-to-bracket me-2"></i>Masuk ke Akun</h4>
        <p>Silakan masukkan kredensial Anda untuk melanjutkan</p>

        <form action="{{ route('login') }}" method="POST">
            @csrf
            <div class="mb-3">
                <label for="email" class="form-label"><i class="fa-solid fa-envelope me-2"></i>Email</label>
                <input type="email" name="email" id="email" class="form-control" placeholder="nama@contoh.com" required>
            </div>

            <div class="mb-3">
                <label for="password" class="form-label"><i class="fa-solid fa-lock me-2"></i>Password</label>
                <input type="password" name="password" id="password" class="form-control" placeholder="Masukkan password Anda" required>
            </div>

            <div class="d-flex justify-content-between align-items-center mb-3">
                <div class="form-check">
                    <input type="checkbox" id="remember" class="form-check-input">
                    <label for="remember" class="form-check-label">Ingat saya</label>
                </div>
                <a href="#" class="forgot-link">Lupa password?</a>
            </div>

            <button type="submit" class="btn btn-primary w-100">Masuk</button>
        </form>

        <p class="text-center mt-3">Belum punya akun? <a href="#" class="forgot-link">Daftar di sini</a></p>

        <div class="footer">
            © 2025 Sistem RW - Pemasyarakatan. All rights reserved.
        </div>
    </div>
</div>

</body>
</html>
