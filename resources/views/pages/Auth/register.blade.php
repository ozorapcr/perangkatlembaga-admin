<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Akun Baru - Sistem RW</title>

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
            --success: #9ce0c2;
            --warning: #ffd6a5;
            --danger: #ffafaf;
            --border-color: #e7e0eb;
            --shadow: 0 4px 20px rgba(0, 0, 0, 0.06);
            --shadow-hover: 0 8px 30px rgba(0, 0, 0, 0.09);
            --border-radius: 16px;
            --transition: all 0.3s ease;
        }

        * { margin: 0; padding: 0; box-sizing: border-box; font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; }

        body {
            background: linear-gradient(135deg, var(--primary-light) 0%, var(--secondary) 100%);
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            padding: 20px;
        }

        /* ==========================================
           REGISTER CONTAINER
        ========================================== */
        .register-container {
            display: flex;
            width: 100%;
            max-width: 1000px;
            background-color: white;
            border-radius: var(--border-radius);
            overflow: hidden;
            box-shadow: var(--shadow);
            animation: slideUp 0.6s ease-out;
            transform-origin: center;
        }

        @keyframes slideUp {
            from { opacity: 0; transform: translateY(30px); }
            to { opacity: 1; transform: translateY(0); }
        }

        /* ==========================================
           LEFT SIDE - INFO
        ========================================== */
        .register-left {
            flex: 1;
            background: var(--primary-gradient);
            color: white;
            padding: 50px 40px;
            display: flex;
            flex-direction: column;
            justify-content: center;
            position: relative;
            overflow: hidden;
        }

        .register-left::before {
            content: '';
            position: absolute;
            inset: 0;
            background: linear-gradient(135deg, rgba(231,184,225,0.9), rgba(213,151,204,0.9));
            z-index: 1;
        }

        .register-left-content {
            position: relative;
            z-index: 2;
            text-align: center;
        }

        /* Logo */
        .logo-wrapper {
            background: white;
            border-radius: 15px;
            padding: 20px;
            margin: 0 auto 20px;
            max-width: 180px;
            box-shadow: var(--shadow);
            display: flex;
            align-items: center;
            justify-content: center;
            min-height: 120px;
        }

        .logo-img { max-width: 100%; max-height: 100px; object-fit: contain; display: block; }
        .logo-fallback { font-size: 36px; font-weight: bold; color: var(--dark); }

        .register-left h1 { font-size: 2rem; margin-bottom: 15px; font-weight: 700; }
        .register-left p { font-size: 1rem; opacity: 0.9; line-height: 1.6; margin-bottom: 20px; }
        .features-list { margin-top: 20px; text-align: left; }
        .feature-item { display: flex; align-items: center; margin-bottom: 12px; }
        .feature-icon { width: 24px; height: 24px; background-color: rgba(255,255,255,0.2); border-radius: 50%; display:flex; align-items:center; justify-content:center; margin-right: 10px; font-size: 0.8rem; }
        .feature-item span { font-size: 0.9rem; }

        /* ==========================================
           RIGHT SIDE - FORM
        ========================================== */
        .register-right {
            flex: 1.2;
            padding: 50px 40px;
        }

        .register-header { text-align: center; margin-bottom: 25px; }
        .register-header h2 { color: var(--dark); font-size: 1.8rem; margin-bottom: 8px; font-weight: 700; }
        .register-header p { color: var(--dark-light); font-size: 0.9rem; }

        .success-container, .error-container { margin-bottom: 20px; }
        .success-message { background-color: rgba(156,224,194,0.15); color: #4a8b72; border-left: 4px solid var(--success); padding: 12px 15px; border-radius: 8px; display: flex; align-items: center; gap: 10px; }
        .error-list { background-color: rgba(255,175,175,0.15); color: #cc6b6b; border-left: 4px solid var(--danger); padding: 12px 15px; border-radius: 8px; font-size: 0.9rem; }

        .form-group { margin-bottom: 18px; }
        label { display: block; margin-bottom: 6px; color: var(--dark); font-weight: 500; font-size: 0.9rem; }
        .input-group { position: relative; }
        input, select { width: 100%; padding: 12px 15px; border: 1px solid var(--border-color); border-radius: 8px; font-size: 0.95rem; transition: var(--transition); background-color: white; }
        input:focus, select:focus { outline: none; border-color: var(--primary); box-shadow: 0 0 0 3px rgba(231,184,225,0.15); }
        input::placeholder { color: var(--gray); }
        .input-icon { position: absolute; right: 15px; top: 50%; transform: translateY(-50%); color: var(--gray); }
        .password-toggle { position: absolute; right: 40px; top: 50%; transform: translateY(-50%); background:none; border:none; cursor:pointer; color: var(--gray); font-size: 0.9rem; }
        .password-toggle:hover { color: var(--primary); }

        .password-strength { height: 4px; background-color: var(--gray-light); border-radius: 2px; margin-top: 6px; overflow: hidden; }
        .strength-meter { height: 100%; width: 0; border-radius: 2px; transition: var(--transition); }
        .strength-weak { background-color: var(--danger); width: 33%; }
        .strength-medium { background-color: var(--warning); width: 66%; }
        .strength-strong { background-color: var(--success); width: 100%; }
        .strength-text { font-size: 0.8rem; margin-top: 4px; text-align: right; color: var(--dark-light); }

        .btn-register { width: 100%; padding: 14px; background: var(--primary-gradient); color: white; border:none; border-radius:8px; font-size:1rem; font-weight:600; cursor:pointer; transition: var(--transition); margin-top:10px; }
        .btn-register:hover { background: linear-gradient(135deg,#d597cc 0%,#e7b8e1 100%); transform: translateY(-2px); box-shadow: var(--shadow-hover); }

        .login-link { text-align: center; margin-top: 20px; font-size: 0.9rem; color: var(--dark-light); }
        .login-link a { color: var(--primary-dark); text-decoration:none; font-weight:500; transition: var(--transition); }
        .login-link a:hover { color:#c284ba; text-decoration:underline; }

        /* Responsive */
        @media (max-width: 992px) { .register-container { flex-direction: column; } .register-left, .register-right { padding: 40px 30px; } .register-left { text-align: center; } }
        @media (max-width: 576px) { .register-left, .register-right { padding: 30px 20px; } .register-left h1 { font-size: 1.8rem; } .register-header h2 { font-size: 1.5rem; } }
    </style>
</head>

<body>
    <div class="register-container">
        <!-- LEFT SIDE -->
        <div class="register-left">
            <div class="register-left-content">
                <!-- Logo -->
                <div class="logo-wrapper">
                    <img src="{{ asset('assets/img/LogoRw.jpg') }}" alt="Logo LPM" class="logo-img" id="logoImage" onerror="handleLogoError()">
                    <div id="logoFallback" class="logo-fallback" style="display:none;">LPM</div>
                </div>

                <h1>Bergabunglah Dengan Sistem RW</h1>
                <p>Daftarkan akun baru untuk mengakses semua fitur dan layanan Sistem RW. Mulai perjalanan Anda bersama kami.</p>

                <div class="features-list">
                    <div class="feature-item"><div class="feature-icon">✓</div><span>Akses ke semua fitur sistem</span></div>
                    <div class="feature-item"><div class="feature-icon">✓</div><span>Kelola data perangkat dan lembaga</span></div>
                    <div class="feature-item"><div class="feature-icon">✓</div><span>Dukungan administrasi RW 24/7</span></div>
                    <div class="feature-item"><div class="feature-icon">✓</div><span>Laporan dan analisis data</span></div>
                </div>
            </div>
        </div>

        <!-- RIGHT SIDE -->
        <div class="register-right">
            <div class="register-header">
                <h2>Buat Akun Baru</h2>
                <p>Isi informasi di bawah untuk mendaftar</p>
            </div>

            <!-- Alerts -->
            @if (session('success'))
                <div class="success-container">
                    <div class="success-message"><i class="fas fa-check-circle"></i> {{ session('success') }}</div>
                </div>
            @endif

            @if ($errors->any())
                <div class="error-container">
                    <div class="error-list">
                        <ul style="margin: 0; padding-left: 20px;">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            @endif

            <!-- REGISTER FORM -->
            <form method="POST" action="{{ route('register.post') }}" id="registerForm">
                @csrf

                <div class="form-group">
                    <label for="name"><i class="fas fa-user me-2"></i>Nama Lengkap</label>
                    <div class="input-group">
                        <input type="text" id="name" name="name" placeholder="Masukkan nama lengkap Anda" required value="{{ old('name') }}">
                        <span class="input-icon"><i class="fas fa-user"></i></span>
                    </div>
                </div>

                <div class="form-group">
                    <label for="email"><i class="fas fa-envelope me-2"></i>Email</label>
                    <div class="input-group">
                        <input type="email" id="email" name="email" placeholder="nama@contoh.com" required value="{{ old('email') }}">
                        <span class="input-icon"><i class="fas fa-envelope"></i></span>
                    </div>
                </div>

                <div class="form-group">
                    <label for="role"><i class="fas fa-user-shield me-2"></i>Role Akun</label>
                    <div class="input-group">
                        <select id="role" name="role" class="form-select" required>
                            <option value="" disabled selected>Pilih Role Anda</option>
                            <option value="Admin" {{ old('role') == 'Admin' ? 'selected' : '' }}>Admin</option>
                            <option value="Pegawai" {{ old('role') == 'Pegawai' ? 'selected' : '' }}>Pegawai</option>
                        </select>
                        <span class="input-icon"><i class="fas fa-user-shield"></i></span>
                    </div>
                </div>

                <div class="form-group">
                    <label for="password"><i class="fas fa-lock me-2"></i>Password</label>
                    <div class="input-group">
                        <input type="password" id="password" name="password" placeholder="Buat password yang kuat" required>
                        <button type="button" class="password-toggle" id="togglePassword"><i class="fas fa-eye"></i></button>
                        <span class="input-icon"><i class="fas fa-lock"></i></span>
                    </div>
                    <div class="password-strength">
                        <div class="strength-meter" id="passwordStrength"></div>
                    </div>
                    <div class="strength-text" id="passwordText">Kekuatan password</div>
                </div>

                <button type="submit" class="btn-register"><i class="fas fa-user-plus me-2"></i>Daftar Sekarang</button>
            </form>

            <div class="login-link">Sudah punya akun? <a href="{{ route('login') }}">Login di sini</a></div>
        </div>
    </div>

    <script>
        // Toggle password visibility
        document.getElementById('togglePassword').addEventListener('click', function() {
            const passwordInput = document.getElementById('password');
            const icon = this.querySelector('i');
            if (passwordInput.type === 'password') {
                passwordInput.type = 'text';
                icon.classList.replace('fa-eye', 'fa-eye-slash');
            } else {
                passwordInput.type = 'password';
                icon.classList.replace('fa-eye-slash', 'fa-eye');
            }
        });

        // Password strength indicator
        document.getElementById('password').addEventListener('input', function() {
            const password = this.value;
            const strengthMeter = document.getElementById('passwordStrength');
            const strengthText = document.getElementById('passwordText');
            strengthMeter.className = 'strength-meter';

            if (!password) { strengthText.textContent='Kekuatan password'; strengthText.style.color=''; return; }

            let strength = 0;
            if (password.length >= 8) strength++;
            if (/[a-z]/.test(password)) strength++;
            if (/[A-Z]/.test(password)) strength++;
            if (/[0-9]/.test(password)) strength++;
            if (/[^A-Za-z0-9]/.test(password)) strength++;

            if (strength <= 2) { strengthMeter.classList.add('strength-weak'); strengthText.textContent='Lemah'; strengthText.style.color='#cc6b6b'; }
            else if (strength <= 4) { strengthMeter.classList.add('strength-medium'); strengthText.textContent='Sedang'; strengthText.style.color='#e6a145'; }
            else { strengthMeter.classList.add('strength-strong'); strengthText.textContent='Kuat'; strengthText.style.color='#4a8b72'; }
        });

        // Logo fallback
        function handleLogoError() {
            document.getElementById('logoImage').style.display='none';
            document.getElementById('logoFallback').style.display='block';
        }
    </script>
</body>

</html>
