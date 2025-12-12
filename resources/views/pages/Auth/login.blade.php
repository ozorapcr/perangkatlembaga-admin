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
        :root {
            --primary-color: #3f51b5;
            --primary-dark: #303f9f;
            --gray-light: #f5f5f5;
            --gray-medium: #e0e0e0;
            --gray-dark: #757575;
            --text-color: #333333;
        }
        
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f8f9fa;
            color: var(--text-color);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
        }
        
        .login-wrapper {
            width: 100%;
            max-width: 1100px;
        }
        
        .login-card {
            background: white;
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
            display: flex;
            height: 600px;
        }
        
        /* Bagian Kiri - Ilustrasi */
        .login-left {
            flex: 1;
            background-color: var(--primary-color);
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
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: linear-gradient(135deg, rgba(63, 81, 181, 0.9), rgba(48, 63, 159, 0.9));
            z-index: 1;
        }
        
        .login-left-content {
            position: relative;
            z-index: 2;
            text-align: center;
        }
        
        .logo-container {
            margin-bottom: 30px;
        }
        
        .logo-wrapper {
            background-color: white;
            border-radius: 15px;
            padding: 20px;
            margin: 0 auto 25px;
            max-width: 250px;
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.15);
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
            text-align: center;
            color: #2c3e50;
            font-weight: bold;
            font-size: 36px;
            padding: 10px;
        }
        
        .system-title {
            color: white;
            margin-top: 15px;
        }
        
        .system-title .main {
            font-size: 28px;
            font-weight: 700;
            letter-spacing: 1px;
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
            text-shadow: 0 2px 4px rgba(0, 0, 0, 0.2);
        }
        
        .login-left p {
            font-size: 16px;
            line-height: 1.6;
            opacity: 0.9;
            margin-bottom: 40px;
        }
        
        .illustration {
            max-width: 300px;
            margin: 0 auto;
            filter: drop-shadow(0 5px 15px rgba(0, 0, 0, 0.2));
        }
        
        /* Bagian Kanan - Form Login */
        .login-right {
            flex: 1;
            padding: 50px 40px;
            display: flex;
            flex-direction: column;
            justify-content: center;
        }
        
        .login-header {
            margin-bottom: 30px;
        }
        
        .login-header h2 {
            font-size: 24px;
            font-weight: 700;
            color: var(--text-color);
            margin-bottom: 10px;
            display: flex;
            align-items: center;
            gap: 10px;
        }
        
        .login-header p {
            color: var(--gray-dark);
            font-size: 15px;
        }
        
        /* Form Styling */
        .form-group {
            margin-bottom: 20px;
        }
        
        .form-label {
            display: block;
            margin-bottom: 8px;
            font-weight: 500;
            color: var(--text-color);
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
            color: var(--gray-dark);
            font-size: 18px;
        }
        
        .form-control {
            width: 100%;
            padding: 14px 15px 14px 45px;
            border: 1px solid var(--gray-medium);
            border-radius: 8px;
            font-size: 16px;
            transition: all 0.3s ease;
            background-color: white;
        }
        
        .form-control:focus {
            outline: none;
            border-color: var(--primary-color);
            box-shadow: 0 0 0 3px rgba(63, 81, 181, 0.1);
        }
        
        /* Password Input */
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
            color: var(--gray-dark);
            cursor: pointer;
            font-size: 18px;
        }
        
        /* Checkbox Styling */
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
        
        .form-check-label {
            font-size: 14px;
            color: var(--text-color);
            cursor: pointer;
        }
        
        /* Forgot Password Link */
        .forgot-password {
            text-align: right;
            margin-bottom: 20px;
        }
        
        .forgot-password a {
            color: var(--primary-color);
            text-decoration: none;
            font-size: 14px;
            transition: color 0.3s ease;
        }
        
        .forgot-password a:hover {
            color: var(--primary-dark);
            text-decoration: underline;
        }
        
        /* Login Button */
        .btn-login {
            width: 100%;
            padding: 14px;
            background-color: var(--primary-color);
            color: white;
            border: none;
            border-radius: 8px;
            font-size: 16px;
            font-weight: 600;
            cursor: pointer;
            transition: background-color 0.3s ease;
            margin-bottom: 25px;
        }
        
        .btn-login:hover {
            background-color: var(--primary-dark);
        }
        
        /* Register Link */
        .register-link {
            text-align: center;
            margin-bottom: 30px;
        }
        
        .register-link p {
            color: var(--gray-dark);
            font-size: 14px;
        }
        
        .register-link a {
            color: var(--primary-color);
            text-decoration: none;
            font-weight: 500;
            transition: color 0.3s ease;
        }
        
        .register-link a:hover {
            color: var(--primary-dark);
            text-decoration: underline;
        }
        
        /* Footer */
        .login-footer {
            text-align: center;
            padding-top: 20px;
            border-top: 1px solid var(--gray-medium);
            color: var(--gray-dark);
            font-size: 13px;
        }
        
        /* Alert Messages */
        .alert-container {
            margin-bottom: 25px;
        }
        
        .alert {
            padding: 12px 15px;
            border-radius: 8px;
            font-size: 14px;
            border: 1px solid transparent;
        }
        
        .alert-success {
            background-color: rgba(76, 175, 80, 0.1);
            color: #2e7d32;
            border-color: rgba(76, 175, 80, 0.2);
        }
        
        .alert-danger {
            background-color: rgba(244, 67, 54, 0.1);
            color: #d32f2f;
            border-color: rgba(244, 67, 54, 0.2);
        }
        
        /* Responsive Design */
        @media (max-width: 992px) {
            .login-card {
                flex-direction: column;
                height: auto;
            }
            
            .login-left, .login-right {
                padding: 40px 30px;
            }
            
            .login-left {
                padding-bottom: 40px;
            }
            
            .logo-wrapper {
                max-width: 220px;
            }
        }
        
        @media (max-width: 576px) {
            .login-left, .login-right {
                padding: 30px 20px;
            }
            
            .login-left h1 {
                font-size: 24px;
            }
            
            .login-header h2 {
                font-size: 22px;
            }
            
            .logo-wrapper {
                max-width: 200px;
                padding: 15px;
            }
            
            .system-title .main {
                font-size: 24px;
            }
            
            .system-title .sub {
                font-size: 14px;
            }
        }
    </style>
</head>
<body>
    <div class="login-wrapper">
        <div class="login-card">
            <!-- Bagian Kiri: Ilustrasi dan Welcome Message -->
            <div class="login-left">
                <div class="login-left-content">
                    <div class="logo-container">
                        <!-- Logo dari file gambar -->
                        <div class="logo-wrapper">
                            <!-- Gambar Logo dari public/images/LogoRw.jpg -->
                            <img src="{{ asset('images/LogoRw.jpg') }}" 
                                 alt="Logo LPM - Sistem RW" 
                                 class="logo-img"
                                 id="logoImage"
                                 onerror="handleLogoError()">
                            
                            <!-- Fallback jika gambar error -->
                            <div id="logoFallback" class="logo-fallback" style="display: none;">
                                LPM
                            </div>
                        </div>
                        
                        <!-- Judul Sistem -->
                        <div class="system-title">
                            <div class="main">SISTEM RW</div>
                            <div class="sub">Pemasyarakatan</div>
                        </div>
                    </div>
                    
                    <h1>Selamat Datang di Sistem RW</h1>
                    <p>Masuk ke akun Anda untuk mengakses semua fitur dan layanan Sistem RW.<br>Kami senang Anda kembali!</p>
                    
                    <div class="illustration">
                        <!-- Ilustrasi login -->
                        <i class="fas fa-users" style="font-size: 150px; opacity: 0.8;"></i>
                    </div>
                </div>
            </div>
            
            <!-- Bagian Kanan: Form Login -->
            <div class="login-right">
                <div class="login-header">
                    <h2>
                        <i class="fas fa-right-to-bracket"></i>
                        Masuk ke Akun
                    </h2>
                    <p>Silakan masukkan kredensial Anda untuk melanjutkan</p>
                </div>
                
                <!-- Alert Messages -->
                <div class="alert-container">
                    @if(session('success'))
                        <div class="alert alert-success">
                            <i class="fas fa-check-circle me-2"></i>
                            {{ session('success') }}
                        </div>
                    @endif
                    
                    @if(session('error'))
                        <div class="alert alert-danger">
                            <i class="fas fa-exclamation-circle me-2"></i>
                            {{ session('error') }}
                        </div>
                    @endif
                    
                    @if($errors->any())
                        <div class="alert alert-danger">
                            <i class="fas fa-exclamation-triangle me-2"></i>
                            @foreach($errors->all() as $error)
                                {{ $error }}<br>
                            @endforeach
                        </div>
                    @endif
                </div>
                
                <!-- Login Form -->
                <form action="{{ route('login.post') }}" method="POST">
                    @csrf
                    
                    <!-- Email Input -->
                    <div class="form-group">
                        <label for="email" class="form-label">
                            <i class="fas fa-envelope me-2"></i>Email
                        </label>
                        <div class="input-with-icon">
                            <span class="input-icon">
                                <i class="fas fa-envelope"></i>
                            </span>
                            <input 
                                type="email" 
                                id="email" 
                                name="email" 
                                class="form-control" 
                                placeholder="gama.pp@yahoo.com" 
                                value="{{ old('email') }}"
                                required
                            >
                        </div>
                    </div>
                    
                    <!-- Password Input -->
                    <div class="form-group">
                        <label for="password" class="form-label">
                            <i class="fas fa-lock me-2"></i>Password
                        </label>
                        <div class="input-with-icon password-input">
                            <span class="input-icon">
                                <i class="fas fa-lock"></i>
                            </span>
                            <input 
                                type="password" 
                                id="password" 
                                name="password" 
                                class="form-control" 
                                placeholder="••••••••" 
                                required
                            >
                            <button type="button" class="toggle-password" id="togglePassword">
                                <i class="fas fa-eye"></i>
                            </button>
                        </div>
                    </div>
                    
                    <!-- Remember Me & Forgot Password -->
                    <div class="d-flex justify-content-between align-items-center mb-4">
                        <div class="form-check">
                            <input type="checkbox" class="form-check-input" id="remember" name="remember">
                            <label class="form-check-label" for="remember">Ingat saya</label>
                        </div>
                        
                        <div class="forgot-password">
                            <a href="#">Lupa password?</a>
                        </div>
                    </div>
                    
                    <!-- Login Button -->
                    <button type="submit" class="btn-login">
                        <i class="fas fa-sign-in-alt me-2"></i>Masuk
                    </button>
                </form>
                
                <!-- Register Link -->
                <div class="register-link">
                    <p>Belum punya akun? <a href="{{ route('register') }}">Daftar di sini</a></p>
                </div>
                
                <!-- Footer -->
                <div class="login-footer">
                    © 2025 Sistem RW - Lembaga Pemberdayaan Masyarakat. All rights reserved.
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    
    <script>
        // Toggle Password Visibility
        const togglePassword = document.getElementById('togglePassword');
        if (togglePassword) {
            togglePassword.addEventListener('click', function() {
                const passwordInput = document.getElementById('password');
                const icon = this.querySelector('i');
                
                if (passwordInput.type === 'password') {
                    passwordInput.type = 'text';
                    icon.classList.remove('fa-eye');
                    icon.classList.add('fa-eye-slash');
                } else {
                    passwordInput.type = 'password';
                    icon.classList.remove('fa-eye-slash');
                    icon.classList.add('fa-eye');
                }
            });
        }
        
        // Handle Logo Error
        function handleLogoError() {
            const logoImg = document.getElementById('logoImage');
            const logoFallback = document.getElementById('logoFallback');
            
            if (logoImg && logoFallback) {
                logoImg.style.display = 'none';
                logoFallback.style.display = 'block';
                
                // Debug info
                console.error('Logo image not found at:', logoImg.src);
                console.info('Showing fallback text instead.');
            }
        }
        
        // Check if logo image exists on page load
        document.addEventListener('DOMContentLoaded', function() {
            const logoImg = document.getElementById('logoImage');
            if (logoImg) {
                // Test if image loads
                const testImage = new Image();
                testImage.onload = function() {
                    console.log('✓ Logo image loaded successfully:', logoImg.src);
                };
                testImage.onerror = function() {
                    console.log('✗ Logo image not found');
                    handleLogoError();
                };
                testImage.src = logoImg.src;
                
                // Also add direct error listener
                logoImg.addEventListener('error', handleLogoError);
            }
        });
        
        // Auto-hide alerts after 5 seconds
        document.addEventListener('DOMContentLoaded', function() {
            const alerts = document.querySelectorAll('.alert');
            alerts.forEach(alert => {
                setTimeout(() => {
                    alert.style.transition = 'opacity 0.5s ease';
                    alert.style.opacity = '0';
                    setTimeout(() => {
                        if (alert.parentElement) {
                            alert.parentElement.removeChild(alert);
                        }
                    }, 500);
                }, 5000);
            });
        });
        
        // Remember email from localStorage if "Remember me" was checked
        document.addEventListener('DOMContentLoaded', function() {
            const rememberCheckbox = document.getElementById('remember');
            const emailInput = document.getElementById('email');
            
            if (rememberCheckbox && emailInput) {
                // Check if email is saved in localStorage
                const savedEmail = localStorage.getItem('rememberedEmail');
                if (savedEmail) {
                    emailInput.value = savedEmail;
                    rememberCheckbox.checked = true;
                }
                
                // Save email to localStorage when checkbox is checked
                rememberCheckbox.addEventListener('change', function() {
                    if (this.checked && emailInput.value) {
                        localStorage.setItem('rememberedEmail', emailInput.value);
                    } else {
                        localStorage.removeItem('rememberedEmail');
                    }
                });
                
                // Auto-save email when typing if checkbox is checked
                emailInput.addEventListener('input', function() {
                    if (rememberCheckbox.checked) {
                        localStorage.setItem('rememberedEmail', this.value);
                    }
                });
            }
        });
    </script>
</body>
</html>