<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Sistem RW</title>

    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">

    <style>
        /* ==========================================
           ROOT COLORS & VARIABLES
        ========================================== */
        :root {
            --primary: #e7b8e1;
            --primary-light: #f9e6f6;
            --primary-dark: #d597cc;
            --primary-gradient: linear-gradient(135deg, #e7b8e1 0%, #f2d2ef 100%);
            --secondary: #c8b6ff;
            --accent: #ffafcc;
            --light: #fff9fe;
            --light-gradient: linear-gradient(135deg, #fff9fe 0%, #fef7ff 100%);
            --dark: #5d576b;
            --dark-light: #8a8498;
            --gray: #a8a2b8;
            --gray-light: #f0e9f2;
            --gray-medium: #e7e0eb;
            --border-radius: 12px;
            --shadow-sm: 0 2px 12px rgba(0, 0, 0, 0.05);
            --shadow-md: 0 8px 30px rgba(0, 0, 0, 0.08);
            --shadow-lg: 0 15px 50px rgba(0, 0, 0, 0.1);
            --transition: all 0.3s ease;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(135deg, var(--primary-light) 0%, var(--secondary) 100%);

            color: var(--dark);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
        }


        /* ==========================================
           LOGIN CARD
        ========================================== */
        .login-wrapper {
            width: 100%;
            max-width: 1100px;
        }

        .login-card {
            display: flex;
            height: 600px;
            border-radius: var(--border-radius);
            overflow: hidden;
            box-shadow: var(--shadow-lg);
            background: white;
        }

        /* LEFT SIDE - ILLUSTRATION */
        .login-left {
            flex: 1;
            background: var(--primary-gradient);
            color: white;
            padding: 50px 40px;
            display: flex;
            flex-direction: column;
            justify-content: center;
            position: relative;
        }

        .login-left::before {
            content: '';
            position: absolute;
            inset: 0;
            background: linear-gradient(135deg, rgba(231, 184, 225, 0.9), rgba(213, 151, 204, 0.9));
            z-index: 1;
        }

        .login-left-content {
            position: relative;
            z-index: 2;
            text-align: center;
        }

        .logo-wrapper {
            background: white;
            border-radius: 15px;
            padding: 20px;
            margin: 0 auto 25px;
            max-width: 250px;
            box-shadow: var(--shadow-md);
            border: 3px solid rgba(255, 255, 255, 0.3);
            display: flex;
            align-items: center;
            justify-content: center;
            min-height: 180px;
        }

        .logo-img {
            max-width: 100%;
            max-height: 140px;
            object-fit: contain;
            display: block;
        }

        .logo-fallback {
            font-size: 36px;
            font-weight: bold;
            color: var(--dark);
        }

        .system-title .main {
            font-size: 28px;
            font-weight: 700;
            margin-bottom: 5px;
        }

        .system-title .sub {
            font-size: 16px;
            opacity: 0.9;
            font-weight: 400;
        }

        .login-left h1 {
            font-size: 28px;
            font-weight: 700;
            margin-bottom: 15px;
            text-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        .login-left p {
            font-size: 16px;
            line-height: 1.6;
            opacity: 0.9;
            margin-bottom: 40px;
        }

        .illustration i {
            font-size: 150px;
            opacity: 0.8;
        }

        /* RIGHT SIDE - FORM */
        .login-right {
            flex: 1;
            padding: 50px 40px;
            display: flex;
            flex-direction: column;
            justify-content: center;
        }

        .login-header h2 {
            font-size: 24px;
            font-weight: 700;
            color: var(--dark);
            margin-bottom: 10px;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .login-header p {
            color: var(--dark-light);
            font-size: 15px;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-label {
            display: block;
            margin-bottom: 8px;
            font-weight: 500;
            color: var(--dark);
            font-size: 14px;
        }

        .input-with-icon {
            position: relative;
        }

        .input-icon {
            position: absolute;
            left: 15px;
            top: 50%;
            transform: translateY(-50%);
            color: var(--gray);
            font-size: 18px;
        }

        .form-control {
            width: 100%;
            padding: 14px 15px 14px 45px;
            border: 1px solid var(--gray-medium);
            border-radius: 8px;
            font-size: 16px;
            transition: var(--transition);
        }

        .form-control:focus {
            outline: none;
            border-color: var(--primary);
            box-shadow: 0 0 0 3px rgba(231, 184, 225, 0.1);
        }

        .password-input {
            position: relative;
        }

        .toggle-password {
            position: absolute;
            right: 15px;
            top: 50%;
            transform: translateY(-50%);
            background: none;
            border: none;
            cursor: pointer;
            font-size: 18px;
            color: var(--gray);
        }

        .form-check {
            display: flex;
            align-items: center;
            margin-bottom: 20px;
        }

        .form-check-input {
            width: 18px;
            height: 18px;
            margin-right: 10px;
            cursor: pointer;
        }

        .form-check-input:checked {
            background-color: var(--primary);
            border-color: var(--primary);
        }

        .form-check-label {
            font-size: 14px;
            color: var(--dark);
            cursor: pointer;
        }

        .forgot-password {
            text-align: right;
            margin-bottom: 20px;
        }

        .forgot-password a {
            color: var(--primary-dark);
            text-decoration: none;
            font-size: 14px;
            transition: var(--transition);
        }

        .forgot-password a:hover {
            color: #c284ba;
            text-decoration: underline;
        }

        .btn-login {
            width: 100%;
            padding: 14px;
            background: var(--primary-gradient);
            color: white;
            border: none;
            border-radius: 8px;
            font-size: 16px;
            font-weight: 600;
            cursor: pointer;
            transition: var(--transition);
            margin-bottom: 25px;
        }

        .btn-login:hover {
            background: linear-gradient(135deg, #d597cc 0%, #e7b8e1 100%);
            transform: translateY(-2px);
            box-shadow: var(--shadow-md);
        }

        .register-link {
            text-align: center;
            margin-bottom: 30px;
        }

        .register-link a {
            color: var(--primary-dark);
            text-decoration: none;
            font-weight: 500;
            transition: var(--transition);
        }

        .register-link a:hover {
            color: #c284ba;
            text-decoration: underline;
        }

        .login-footer {
            text-align: center;
            padding-top: 20px;
            border-top: 1px solid var(--gray-medium);
            color: var(--dark-light);
            font-size: 13px;
        }

        .alert {
            padding: 12px 15px;
            border-radius: 8px;
            font-size: 14px;
            border: 1px solid transparent;
            margin-bottom: 20px;
        }

        .alert-success {
            background-color: rgba(156, 224, 194, 0.15);
            color: #4a8b72;
            border-color: rgba(156, 224, 194, 0.2);
        }

        .alert-danger {
            background-color: rgba(255, 175, 175, 0.15);
            color: #cc6b6b;
            border-color: rgba(255, 175, 175, 0.2);
        }

        /* Responsive */
        @media (max-width: 992px) {
            .login-card {
                flex-direction: column;
                height: auto;
            }
        }

        @media (max-width: 576px) {

            .login-left,
            .login-right {
                padding: 30px 20px;
            }
        }
    </style>
</head>

<body>
    <div class="login-wrapper">
        <div class="login-card">
            <!-- LEFT -->
            <div class="login-left">
                <div class="login-left-content">
                    <div class="logo-wrapper">
                        <img src="{{ asset('assets/img/LogoRw.jpg') }}" alt="Logo" class="logo-img" id="logoImage"
                            onerror="handleLogoError()">
                        <div id="logoFallback" class="logo-fallback" style="display:none;">LPM</div>
                    </div>
                    <div class="system-title">
                        <div class="main">SISTEM RW</div>
                        <div class="sub">Pemasyarakatan</div>
                    </div>
                    <h1>Selamat Datang</h1>
                    <p>Masuk ke akun Anda untuk mengakses fitur Sistem RW.</p>
                    <div class="illustration"><i class="fas fa-users"></i></div>
                </div>
            </div>

            <!-- RIGHT -->
            <div class="login-right">
                <div class="login-header">
                    <h2><i class="fas fa-right-to-bracket"></i> Masuk ke Akun</h2>
                    <p>Silakan masukkan kredensial Anda</p>
                </div>

                <div class="alert-container">
                    @if (session('success'))
                        <div class="alert alert-success"><i
                                class="fas fa-check-circle me-2"></i>{{ session('success') }}</div>
                    @endif
                    @if (session('error'))
                        <div class="alert alert-danger"><i
                                class="fas fa-exclamation-circle me-2"></i>{{ session('error') }}</div>
                    @endif
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            @foreach ($errors->all() as $error)
                                {{ $error }}
                                <br>
                            @endforeach
                        </div>
                    @endif
                </div>

                <form action="{{ route('login.post') }}" method="POST">@csrf
                    <div class="form-group">
                        <label for="email" class="form-label">Email</label>
                        <div class="input-with-icon">
                            <span class="input-icon"><i class="fas fa-envelope"></i></span>
                            <input type="email" id="email" name="email" class="form-control"
                                placeholder="gama.pp@yahoo.com" value="{{ old('email') }}" required>
                        </div>
                    </div>

                    <div class="form-group password-input">
                        <label for="password" class="form-label">Password</label>
                        <div class="input-with-icon">
                            <span class="input-icon"><i class="fas fa-lock"></i></span>
                            <input type="password" id="password" name="password" class="form-control"
                                placeholder="••••••••" required>
                            <button type="button" class="toggle-password" id="togglePassword"><i
                                    class="fas fa-eye"></i></button>
                        </div>
                    </div>

                    <div class="d-flex justify-content-between align-items-center mb-4">
                        <div class="form-check">
                            <input type="checkbox" class="form-check-input" id="remember" name="remember">
                            <label class="form-check-label" for="remember">Ingat saya</label>
                        </div>
                        <div class="forgot-password"><a href="#">Lupa password?</a></div>
                    </div>

                    <button type="submit" class="btn-login"><i class="fas fa-sign-in-alt me-2"></i>Masuk</button>
                </form>

                <div class="register-link">
                    <p>Belum punya akun? <a href="{{ route('register') }}">Daftar di sini</a></p>
                </div>
                <div class="login-footer">© 2025 Sistem RW - LPM. All rights reserved.</div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Toggle Password
        const togglePassword = document.getElementById('togglePassword');
        togglePassword?.addEventListener('click', () => {
            const passwordInput = document.getElementById('password');
            const icon = togglePassword.querySelector('i');
            if (passwordInput.type === 'password') {
                passwordInput.type = 'text';
                icon.classList.replace('fa-eye', 'fa-eye-slash');
            } else {
                passwordInput.type = 'password';
                icon.classList.replace('fa-eye-slash', 'fa-eye');
            }
        });

        // Logo fallback
        function handleLogoError() {
            document.getElementById('logoImage').style.display = 'none';
            document.getElementById('logoFallback').style.display = 'block';
        }

        // Auto-hide alerts
        document.addEventListener('DOMContentLoaded', () => {
            document.querySelectorAll('.alert').forEach(alert => {
                setTimeout(() => {
                    alert.style.opacity = '0';
                    setTimeout(() => alert.remove(), 500);
                }, 5000);
            });
        });
    </script>
</body>

</html>
