<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Sistem RW</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background: url('https://editorindonesia.com/menkop-budi-arie-asosiasi-kepala-perangkat-dan-lembaga-desa-dukung-kopdes-merah-putih/') no-repeat center center fixed;
            background-size: cover;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
        }
        
        .login-card {
            background-color: rgba(255, 255, 255, 0.95);
            border-radius: 15px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.2);
            width: 100%;
            max-width: 450px;
            overflow: hidden;
        }
        
        .login-header {
            background-color: #2c3e50;
            color: white;
            padding: 25px;
            text-align: center;
        }
        
        .login-header h1 {
            font-size: 2.5rem;
            font-weight: bold;
            margin-bottom: 5px;
        }
        
        .login-header h2 {
            font-size: 1.8rem;
            margin-bottom: 10px;
        }
        
        .login-header h3 {
            font-size: 1.4rem;
            margin-top: 15px;
            margin-bottom: 10px;
        }
        
        .login-header p {
            font-size: 0.95rem;
            opacity: 0.9;
            margin-bottom: 5px;
        }
        
        .login-body {
            padding: 30px;
        }
        
        .form-label {
            font-weight: bold;
            color: #333;
            margin-bottom: 8px;
            display: block;
        }
        
        .email-display {
            background-color: #f8f9fa;
            border: 1px solid #dee2e6;
            padding: 12px 15px;
            border-radius: 8px;
            color: #495057;
            margin-bottom: 20px;
        }
        
        .form-control {
            padding: 12px 15px;
            border-radius: 8px;
            border: 1px solid #ced4da;
        }
        
        .form-control:focus {
            border-color: #2c3e50;
            box-shadow: 0 0 0 0.2rem rgba(44, 62, 80, 0.25);
        }
        
        .forgot-password {
            color: #3498db;
            text-decoration: none;
            font-size: 0.9rem;
        }
        
        .forgot-password:hover {
            text-decoration: underline;
        }
        
        .login-btn {
            background-color: #2c3e50;
            color: white;
            border: none;
            padding: 12px;
            border-radius: 8px;
            width: 100%;
            font-weight: bold;
            font-size: 1.1rem;
            margin-top: 10px;
            transition: background-color 0.3s;
        }
        
        .login-btn:hover {
            background-color: #1a252f;
        }
        
        .signup-link {
            text-align: center;
            margin-top: 20px;
            color: #666;
        }
        
        .signup-link a {
            color: #2c3e50;
            font-weight: bold;
            text-decoration: none;
        }
        
        .signup-link a:hover {
            text-decoration: underline;
        }
        
        .login-footer {
            text-align: center;
            padding: 20px;
            color: #777;
            font-size: 0.85rem;
            border-top: 1px solid #eee;
            background-color: #f8f9fa;
        }
        
        hr {
            margin: 25px 0;
            border-top: 2px solid #eee;
        }
    </style>
</head>
<body>
    <div class="login-card">
        <!-- Header -->
        <div class="login-header">
            <h1>LPM</h1>
            <h2>SISTEM RW</h2>
            <h3>Pemasyarakatan</h3>
            <h3>Selamat Datang di Sistem RW</h3>
            <p>Masuk ke akun Anda untuk mengakses semua fitur dan layanan Sistem RW.</p>
            <p>Kami senang Anda kembali</p>
        </div>
        
        <!-- Body -->
        <div class="login-body">
            <h4 style="font-weight: bold; color: #333; margin-bottom: 10px;">Masuk ke Akun</h4>
            <p style="color: #666; margin-bottom: 25px;">Silakan masukkan kredensial Anda untuk melanjutkan</p>
            
            <hr>
            
            <!-- Email -->
            <div class="mb-4">
                <label class="form-label">Email</label>
                <div class="email-display">ozora24s@mahasiswa.pcr.ac.id</div>
            </div>
            
            <!-- Password -->
            <div class="mb-4">
                <label class="form-label">Password</label>
                <input type="password" class="form-control" placeholder="Masukkan password Anda">
                <div class="text-end mt-2">
                    <a href="#" class="forgot-password">Lupa password?</a>
                </div>
            </div>
            
            <!-- Ingat Saya Checkbox -->
            <div class="mb-4">
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" id="rememberMe">
                    <label class="form-check-label" for="rememberMe">
                        Ingat saya
                    </label>
                </div>
            </div>
            
            <!-- Login Button -->
            <button class="login-btn">Masuk</button>
            
            <!-- Signup Link -->
            <div class="signup-link">
                Belum punya akun? <a href="#">Daftar di sini</a>
            </div>
        </div>
        
        <!-- Footer -->
        <div class="login-footer">
            © 2025 Sistem RW - Lembaga Pemberdayaan Masyarakat. All rights reserved.
        </div>
    </div>

    <script>
        // Simple form submission handler
        document.querySelector('.login-btn').addEventListener('click', function() {
            const password = document.querySelector('input[type="password"]').value;
            
            if (!password) {
                alert('Silakan masukkan password Anda.');
                return;
            }
            
            // Show loading
            this.textContent = 'Memproses...';
            this.disabled = true;
            
            // Simulate login process
            setTimeout(() => {
                alert('Login berhasil! (Simulasi)');
                this.textContent = 'Masuk';
                this.disabled = false;
            }, 1500);
        });
    </script>
</body>
</html>