<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Akun Baru - Sistem Kami</title>
    <style>
        :root {
            --primary-color: #4361ee;
            --primary-dark: #3a56d4;
            --secondary-color: #f8f9fa;
            --text-color: #333;
            --text-light: #6c757d;
            --error-color: #e63946;
            --success-color: #2a9d8f;
            --border-color: #dee2e6;
            --shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
            --shadow-hover: 0 8px 20px rgba(0, 0, 0, 0.15);
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        body {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            padding: 20px;
            animation: gradientShift 8s ease infinite;
            background-size: 200% 200%;
        }

        @keyframes gradientShift {
            0% { background-position: 0% 50%; }
            50% { background-position: 100% 50%; }
            100% { background-position: 0% 50%; }
        }

        .register-container {
            display: flex;
            width: 100%;
            max-width: 1000px;
            background-color: white;
            border-radius: 16px;
            overflow: hidden;
            box-shadow: var(--shadow);
            animation: slideUp 0.6s ease-out;
            transform-origin: center;
        }

        @keyframes slideUp {
            from { opacity: 0; transform: translateY(30px); }
            to { opacity: 1; transform: translateY(0); }
        }

        .register-left {
            flex: 1;
            background: linear-gradient(135deg, var(--primary-color), var(--primary-dark));
            color: white;
            padding: 50px 40px;
            display: flex;
            flex-direction: column;
            justify-content: center;
            position: relative;
            overflow: hidden;
        }

        .register-left h1 {
            font-size: 2.5rem;
            margin-bottom: 20px;
        }

        .register-left p {
            font-size: 1.1rem;
            opacity: 0.9;
            line-height: 1.6;
        }

        .features-list { margin-top: 30px; }
        .feature-item {
            display: flex;
            align-items: center;
            margin-bottom: 15px;
        }

        .feature-icon {
            width: 24px;
            height: 24px;
            background-color: rgba(255,255,255,0.2);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-right: 12px;
        }

        .register-right {
            flex: 1.2;
            padding: 50px 40px;
        }

        .register-header {
            text-align: center;
            margin-bottom: 30px;
        }

        .register-header h2 {
            color: var(--text-color);
            font-size: 2rem;
            margin-bottom: 8px;
        }

        .register-header p {
            color: var(--text-light);
            font-size: 0.95rem;
        }

        .success-container {
            margin-bottom: 20px;
        }

        .success-message {
            background-color: rgba(42, 157, 143, 0.1);
            color: var(--success-color);
            border-left: 4px solid var(--success-color);
            padding: 12px 15px;
            border-radius: 8px;
            font-size: 0.9rem;
        }

        .error-container {
            margin-bottom: 20px;
        }

        .error-list {
            background-color: rgba(230, 57, 70, 0.1);
            color: var(--error-color);
            border-left: 4px solid var(--error-color);
            padding: 12px 15px;
            border-radius: 8px;
            font-size: 0.9rem;
        }

        .form-group {
            margin-bottom: 20px;
        }

        label {
            display: block;
            margin-bottom: 8px;
            color: var(--text-color);
            font-weight: 500;
        }

        .input-group {
            position: relative;
        }

        input {
            width: 100%;
            padding: 14px 15px;
            border: 1px solid var(--border-color);
            border-radius: 8px;
            font-size: 1rem;
            transition: all 0.3s ease;
        }

        input:focus {
            outline: none;
            border-color: var(--primary-color);
            box-shadow: 0 0 0 3px rgba(67, 97, 238, 0.2);
        }

        .input-icon {
            position: absolute;
            right: 15px;
            top: 50%;
            transform: translateY(-50%);
            color: var(--text-light);
        }

        .password-toggle {
            position: absolute;
            right: 40px;
            top: 50%;
            transform: translateY(-50%);
            background: none;
            border: none;
            cursor: pointer;
            color: var(--text-light);
        }

        .password-toggle:hover {
            color: var(--primary-color);
        }

        .password-strength {
            height: 4px;
            background-color: #e9ecef;
            border-radius: 2px;
            margin-top: 8px;
            overflow: hidden;
        }

        .strength-meter {
            height: 100%;
            width: 0;
            border-radius: 2px;
            transition: all 0.3s ease;
        }

        .strength-weak { background-color: var(--error-color); width: 33%; }
        .strength-medium { background-color: #ff9f1c; width: 66%; }
        .strength-strong { background-color: var(--success-color); width: 100%; }

        .strength-text {
            font-size: 0.8rem;
            margin-top: 4px;
            text-align: right;
        }

        .btn-register {
            width: 100%;
            padding: 14px;
            background-color: var(--primary-color);
            color: white;
            border: none;
            border-radius: 8px;
            font-size: 1rem;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .btn-register:hover {
            background-color: var(--primary-dark);
        }

        .login-link {
            text-align: center;
            margin-top: 25px;
            color: var(--text-light);
            font-size: 0.95rem;
        }

        .login-link a {
            color: var(--primary-color);
            text-decoration: none;
            font-weight: 500;
        }
    </style>
</head>
<body>
    <div class="register-container">
        <div class="register-left">
            <h1>Bergabunglah Dengan Kami</h1>
            <p>Daftarkan akun baru untuk mengakses semua fitur eksklusif dan mulai perjalanan Anda bersama kami.</p>

            <div class="features-list">
                <div class="feature-item">
                    <div class="feature-icon">✓</div>
                    <span>Akses ke semua fitur premium</span>
                </div>
                <div class="feature-item">
                    <div class="feature-icon">✓</div>
                    <span>Pengalaman personalisasi</span>
                </div>
                <div class="feature-item">
                    <div class="feature-icon">✓</div>
                    <span>Dukungan pelanggan 24/7</span>
                </div>
            </div>
        </div>

        <div class="register-right">
            <div class="register-header">
                <h2>Buat Akun Baru</h2>
                <p>Isi informasi di bawah untuk mendaftar</p>
            </div>

            @if(session('success'))
                <div class="success-container">
                    <div class="success-message">
                        {{ session('success') }}
                    </div>
                </div>
            @endif

            @if ($errors->any())
                <div class="error-container">
                    <div class="error-list">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            @endif

            <form method="POST" action="{{ route('register.post') }}" id="registerForm">
                @csrf

                <div class="form-group">
                    <label for="name">Nama Lengkap</label>
                    <div class="input-group">
                        <input type="text" id="name" name="name" placeholder="Masukkan nama lengkap Anda" required value="{{ old('name') }}">
                        <span class="input-icon">👤</span>
                    </div>
                </div>

                <div class="form-group">
                    <label for="email">Alamat Email</label>
                    <div class="input-group">
                        <input type="email" id="email" name="email" placeholder="nama@contoh.com" required value="{{ old('email') }}">
                        <span class="input-icon">✉️</span>
                    </div>
                </div>

                <div class="form-group">
                    <label for="password">Password</label>
                    <div class="input-group">
                        <input type="password" id="password" name="password" placeholder="Buat password yang kuat" required>
                        <button type="button" class="password-toggle" id="togglePassword">👁️</button>
                        <span class="input-icon">🔒</span>
                    </div>
                    <div class="password-strength">
                        <div class="strength-meter" id="passwordStrength"></div>
                    </div>
                    <div class="strength-text" id="passwordText">Kekuatan password</div>
                </div>

                <button type="submit" class="btn-register">Daftar Sekarang</button>
            </form>

            <div class="login-link">
                Sudah punya akun? <a href="{{ route('login') }}">Login di sini</a>
            </div>
        </div>
    </div>

    <script>
        // Toggle password visibility
        document.getElementById('togglePassword').addEventListener('click', function() {
            const passwordInput = document.getElementById('password');
            const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
            passwordInput.setAttribute('type', type);
            this.innerHTML = type === 'password' ? '👁️' : '🔒';
        });

        // Password strength indicator
        document.getElementById('password').addEventListener('input', function() {
            const password = this.value;
            const strengthMeter = document.getElementById('passwordStrength');
            const strengthText = document.getElementById('passwordText');
            strengthMeter.className = 'strength-meter';

            if (password.length === 0) {
                strengthText.textContent = 'Kekuatan password';
                strengthText.style.color = '';
                return;
            }

            let strength = 0;
            if (password.length >= 8) strength++;
            if (/[a-z]/.test(password)) strength++;
            if (/[A-Z]/.test(password)) strength++;
            if (/[0-9]/.test(password)) strength++;
            if (/[^A-Za-z0-9]/.test(password)) strength++;

            if (strength <= 2) {
                strengthMeter.classList.add('strength-weak');
                strengthText.textContent = 'Lemah';
                strengthText.style.color = 'var(--error-color)';
            } else if (strength <= 4) {
                strengthMeter.classList.add('strength-medium');
                strengthText.textContent = 'Sedang';
                strengthText.style.color = '#ff9f1c';
            } else {
                strengthMeter.classList.add('strength-strong');
                strengthText.textContent = 'Kuat';
                strengthText.style.color = 'var(--success-color)';
            }
        });
    </script>
</body>
</html>