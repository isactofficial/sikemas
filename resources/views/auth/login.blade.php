<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - SIKEMAS</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Besley:wght@400;500;600;700;800;900&display=swap" rel="stylesheet">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Besley', serif;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            position: relative;
            overflow: auto;
            padding: 2rem 1rem;
        }

        .login-background {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            object-fit: cover;
            z-index: -1;
        }

        .login-container {
            background-color: white;
            border-radius: 12px;
            box-shadow: 0 10px 40px rgba(0, 0, 0, 0.1);
            padding: 2rem 2rem;
            max-width: 400px;
            width: 90%;
            text-align: center;
            margin: auto;
        }

        .logo-container {
            margin-bottom: 1rem;
        }

        .logo-container img {
            width: 60px;
            height: 60px;
            margin: 0 auto;
        }

        .login-title {
            color: #074159;
            font-size: 1.4rem;
            font-weight: 700;
            margin-bottom: 0.4rem;
        }

        .login-subtitle {
            color: #666;
            font-size: 0.85rem;
            margin-bottom: 1.25rem;
            line-height: 1.4;
        }

        .alert {
            padding: 0.75rem;
            border-radius: 6px;
            margin-bottom: 1rem;
            font-size: 0.85rem;
            text-align: left;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .alert-danger {
            background-color: #fee;
            border: 1px solid #fcc;
            color: #c33;
        }

        .alert-icon {
            width: 18px;
            height: 18px;
            flex-shrink: 0;
        }

        .form-group {
            margin-bottom: 1rem;
            text-align: left;
        }

        .form-label {
            display: block;
            color: #333;
            font-size: 0.85rem;
            font-weight: 600;
            margin-bottom: 0.4rem;
        }

        .input-wrapper {
            position: relative;
        }

        .input-icon {
            position: absolute;
            left: 12px;
            top: 50%;
            transform: translateY(-50%);
            width: 20px;
            height: 20px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .input-icon svg {
            width: 100%;
            height: 100%;
            fill: #074159;
            stroke: none;
        }

        .toggle-password {
            position: absolute;
            right: 12px;
            top: 50%;
            transform: translateY(-50%);
            background: none;
            border: none;
            cursor: pointer;
            padding: 4px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .toggle-password svg {
            width: 20px;
            height: 20px;
            fill: #666;
            transition: fill 0.3s ease;
        }

        .toggle-password:hover svg {
            fill: #074159;
        }

        .form-input {
            width: 100%;
            padding: 0.75rem 2.5rem 0.75rem 2.5rem;
            border: 1px solid #ddd;
            border-radius: 6px;
            font-family: 'Besley', serif;
            font-size: 0.9rem;
            transition: all 0.3s ease;
        }

        .form-input:focus {
            outline: none;
            border-color: #074159;
            box-shadow: 0 0 0 3px rgba(7, 65, 89, 0.1);
        }

        .form-input::placeholder {
            color: #999;
        }

        .form-input.error {
            border-color: #c33;
        }

        .forgot-password {
            text-align: right;
            margin-top: 0.4rem;
        }

        .forgot-password a {
            color: #4ECDC4;
            font-size: 0.8rem;
            text-decoration: none;
            transition: color 0.3s ease;
        }

        .forgot-password a:hover {
            color: #3DBDB4;
            text-decoration: underline;
        }

        .login-button {
            width: 100%;
            background-color: #074159;
            color: white;
            padding: 0.75rem;
            border: none;
            border-radius: 6px;
            font-family: 'Besley', serif;
            font-size: 0.95rem;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            margin-top: 0.5rem;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 0.5rem;
        }

        .login-button:hover {
            background-color: #053244;
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(7, 65, 89, 0.3);
        }

        .divider {
            display: flex;
            align-items: center;
            margin: 1rem 0;
            color: #999;
            font-size: 0.8rem;
        }

        .divider::before,
        .divider::after {
            content: '';
            flex: 1;
            height: 1px;
            background-color: #ddd;
        }

        .divider::before {
            margin-right: 1rem;
        }

        .divider::after {
            margin-left: 1rem;
        }

        .register-text {
            color: #666;
            font-size: 0.85rem;
            margin-top: 1rem;
            margin-bottom: 0.75rem;
        }

        .register-text a {
            color: #ff5722;
            font-weight: 600;
            text-decoration: none;
        }

        .register-text a:hover {
            text-decoration: underline;
        }

        .google-button {
            width: 100%;
            background-color: white;
            color: #333;
            padding: 0.65rem;
            border: 1px solid #ddd;
            border-radius: 6px;
            font-family: 'Besley', serif;
            font-size: 0.85rem;
            font-weight: 500;
            cursor: pointer;
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 0.5rem;
            margin-bottom: 0.75rem;
        }

        .google-button:hover {
            background-color: #f8f9fa;
            border-color: #bbb;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
        }

        .google-icon {
            width: 20px;
            height: 20px;
        }

        .back-button {
            width: 100%;
            background-color: white;
            color: #074159;
            padding: 0.65rem;
            border: 1px solid #074159;
            border-radius: 6px;
            font-family: 'Besley', serif;
            font-size: 0.85rem;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 0.5rem;
            text-decoration: none;
        }

        .back-button:hover {
            background-color: #074159;
            color: white;
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(7, 65, 89, 0.2);
        }

        @media (max-width: 480px) {
            .login-container {
                padding: 2rem 1.5rem;
            }

            .login-title {
                font-size: 1.5rem;
            }

            .login-subtitle {
                font-size: 0.85rem;
            }
        }
    </style>
</head>
<body>
    <img src="{{ asset('assets/img/Login_Page.png') }}" alt="Background" class="login-background">
    
    <div class="login-container">
        <div class="logo-container">
            <img src="{{ asset('assets/img/BackgroundShadow.png') }}" alt="SIKEMAS Logo">
        </div>

        <h1 class="login-title">Selamat Datang di Sikemas</h1>
        <p class="login-subtitle">Masuk ke akun Anda dan mulai kembangkan ide kemasan brilian!</p>

        @if($errors->any())
        <div class="alert alert-danger">
            <svg class="alert-icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor">
                <path fill-rule="evenodd" d="M9.401 3.003c1.155-2 4.043-2 5.197 0l7.355 12.748c1.154 2-.29 4.5-2.599 4.5H4.645c-2.309 0-3.752-2.5-2.598-4.5L9.4 3.003zM12 8.25a.75.75 0 01.75.75v3.75a.75.75 0 01-1.5 0V9a.75.75 0 01.75-.75zm0 8.25a.75.75 0 100-1.5.75.75 0 000 1.5z" clip-rule="evenodd"/>
            </svg>
            <span>{{ $errors->first() }}</span>
        </div>
        @endif

        <form action="{{ url('/login') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="email" class="form-label">Email</label>
                <div class="input-wrapper">
                    <span class="input-icon">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                            <path d="M1.5 8.67v8.58a3 3 0 003 3h15a3 3 0 003-3V8.67l-8.928 5.493a3 3 0 01-3.144 0L1.5 8.67z"/>
                            <path d="M22.5 6.908V6.75a3 3 0 00-3-3h-15a3 3 0 00-3 3v.158l9.714 5.978a1.5 1.5 0 001.572 0L22.5 6.908z"/>
                        </svg>
                    </span>
                    <input 
                        type="email" 
                        id="email" 
                        name="email" 
                        class="form-input @error('email') error @enderror" 
                        placeholder="nama@sikemas.com"
                        value="{{ old('email') }}"
                        required
                    >
                </div>
            </div>

            <div class="form-group">
                <label for="password" class="form-label">Password</label>
                <div class="input-wrapper">
                    <span class="input-icon">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                            <path fill-rule="evenodd" d="M12 1.5a5.25 5.25 0 00-5.25 5.25v3a3 3 0 00-3 3v6.75a3 3 0 003 3h10.5a3 3 0 003-3v-6.75a3 3 0 00-3-3v-3c0-2.9-2.35-5.25-5.25-5.25zm3.75 8.25v-3a3.75 3.75 0 10-7.5 0v3h7.5z" clip-rule="evenodd"/>
                        </svg>
                    </span>
                    <input 
                        type="password" 
                        id="password" 
                        name="password" 
                        class="form-input @error('password') error @enderror" 
                        placeholder="Password Anda"
                        required
                    >
                    <button type="button" class="toggle-password" onclick="togglePassword('password')">
                        <svg id="eye-icon-password" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor">
                            <path d="M12 15a3 3 0 100-6 3 3 0 000 6z"/>
                            <path fill-rule="evenodd" d="M1.323 11.447C2.811 6.976 7.028 3.75 12.001 3.75c4.97 0 9.185 3.223 10.675 7.69.12.362.12.752 0 1.113-1.487 4.471-5.705 7.697-10.677 7.697-4.97 0-9.186-3.223-10.675-7.69a1.762 1.762 0 010-1.113zM17.25 12a5.25 5.25 0 11-10.5 0 5.25 5.25 0 0110.5 0z" clip-rule="evenodd"/>
                        </svg>
                    </button>
                </div>
                <div class="forgot-password">
                    <a href="{{ url('/forgot-password') }}">Lupa Password?</a>
                </div>
            </div>

            <button type="submit" class="login-button">
                → Masuk Akun
            </button>
        </form>

        <div class="register-text">
            Belum punya akun? <a href="{{ url('/register') }}">Daftar di sini</a>
        </div>

        <div class="divider">Atau masuk dengan</div>

        <button type="button" class="google-button" onclick="window.location.href='{{ url('/auth/google') }}'">
            <svg class="google-icon" viewBox="0 0 24 24">
                <path fill="#4285F4" d="M22.56 12.25c0-.78-.07-1.53-.2-2.25H12v4.26h5.92c-.26 1.37-1.04 2.53-2.21 3.31v2.77h3.57c2.08-1.92 3.28-4.74 3.28-8.09z"/>
                <path fill="#34A853" d="M12 23c2.97 0 5.46-.98 7.28-2.66l-3.57-2.77c-.98.66-2.23 1.06-3.71 1.06-2.86 0-5.29-1.93-6.16-4.53H2.18v2.84C3.99 20.53 7.7 23 12 23z"/>
                <path fill="#FBBC05" d="M5.84 14.09c-.22-.66-.35-1.36-.35-2.09s.13-1.43.35-2.09V7.07H2.18C1.43 8.55 1 10.22 1 12s.43 3.45 1.18 4.93l2.85-2.22.81-.62z"/>
                <path fill="#EA4335" d="M12 5.38c1.62 0 3.06.56 4.21 1.64l3.15-3.15C17.45 2.09 14.97 1 12 1 7.7 1 3.99 3.47 2.18 7.07l3.66 2.84c.87-2.6 3.3-4.53 6.16-4.53z"/>
            </svg>
            Google
        </button>

        <a href="{{ url('/') }}" class="back-button">
            ← Kembali ke Beranda
        </a>
    </div>

    <script>
        function togglePassword(fieldId) {
            const field = document.getElementById(fieldId);
            const icon = document.getElementById('eye-icon-' + fieldId);
            
            if (field.type === 'password') {
                field.type = 'text';
                icon.innerHTML = '<path d="M3.53 2.47a.75.75 0 00-1.06 1.06l18 18a.75.75 0 101.06-1.06l-18-18zM22.676 12.553a11.249 11.249 0 01-2.631 4.31l-3.099-3.099a5.25 5.25 0 00-6.71-6.71L7.759 4.577a11.217 11.217 0 014.242-.827c4.97 0 9.185 3.223 10.675 7.69.12.362.12.752 0 1.113z"/><path d="M15.75 12c0 .18-.013.357-.037.53l-4.244-4.243A3.75 3.75 0 0115.75 12zM12.53 15.713l-4.243-4.244a3.75 3.75 0 004.243 4.243z"/><path d="M6.75 12c0-.619.107-1.213.304-1.764l-3.1-3.1a11.25 11.25 0 00-2.63 4.31c-.12.362-.12.752 0 1.114 1.489 4.467 5.704 7.69 10.675 7.69 1.5 0 2.933-.294 4.242-.827l-2.477-2.477A5.25 5.25 0 016.75 12z"/>';
            } else {
                field.type = 'password';
                icon.innerHTML = '<path d="M12 15a3 3 0 100-6 3 3 0 000 6z"/><path fill-rule="evenodd" d="M1.323 11.447C2.811 6.976 7.028 3.75 12.001 3.75c4.97 0 9.185 3.223 10.675 7.69.12.362.12.752 0 1.113-1.487 4.471-5.705 7.697-10.677 7.697-4.97 0-9.186-3.223-10.675-7.69a1.762 1.762 0 010-1.113zM17.25 12a5.25 5.25 0 11-10.5 0 5.25 5.25 0 0110.5 0z" clip-rule="evenodd"/>';
            }
        }
    </script>
</body>
</html>