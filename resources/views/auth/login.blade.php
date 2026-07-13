<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Login SIAD</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="{{ asset('css/login.css') }}">

</head>

<body class="login-page">
    <div class="login-card">
        <div class="login-logo">
            <div class="logo-box">
                <i class="bi bi-people"></i>
            </div>
        </div>

        <h1>Login SIAD</h1>
        <p class="subtitle">
            Sistem Absensi Digital
        </p>

        <div class="title-divider"></div>
        @if(session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
        @endif

        <form method="POST" action="{{ route('login') }}">
            @csrf
            <div class="mb-4">
                <label>Email</label>
                <div class="input-wrapper">
                    <i class="bi bi-envelope"></i>
                    <input
                        type="email"
                        name="email"
                        placeholder="Masukkan email Anda"
                        required>
                </div>
            </div>

            <div class="mb-4">
                <label>Password</label>
                <div class="input-wrapper">
                    <i class="bi bi-lock"></i>
                    <input
                        type="password"
                        id="password"
                        name="password"
                        placeholder="Masukkan password Anda"
                        required>

                    <button
                        type="button"
                        id="togglePassword"
                        class="eye-btn">
                        <i class="bi bi-eye"></i>
                    </button>
                </div>
            </div>

            <div class="login-option">
                <div>
                    <input
                        type="checkbox"
                        name="remember">
                    <span>Ingat saya</span>
                </div>
                <a href="#">
                    Lupa password?
                </a>
            </div>

            <button type="submit" class="btn-login">
                Login
            </button>
        </form>

        <div class="divider">
            <span>atau masuk dengan</span>
        </div>

        <a href="#" class="btn-admin">
            <i class="bi bi-shield-check"></i>
            Login sebagai HR / Admin
        </a>
    </div>

    <script>
        const togglePassword =
            document.getElementById('togglePassword');
        const password =
            document.getElementById('password');
        togglePassword.addEventListener('click', function() {
            if (password.type === 'password') {
                password.type = 'text';
                this.innerHTML =
                    '<i class="bi bi-eye-slash"></i>';
            } else {
                password.type = 'password';
                this.innerHTML =
                    '<i class="bi bi-eye"></i>';
            }
        });
    </script>

</body>
</html>