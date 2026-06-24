<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SIAD - Sistem Absensi Digital</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>

<body>

    <div class="main-wrapper">

        <!-- Sidebar -->
        <div class="sidebar">

            <div class="logo">
                <div class="logo-icon">
                    <i class="bi bi-building"></i>
                </div>

                <div>
                    <h6 class="mb-0 text-white">SIAD</h6>
                    <small class="text-secondary">
                        Sistem Absensi
                    </small>
                </div>
            </div>

            <ul class="nav-menu">

                <li>
                    <a href="/dashboard/hr" class="{{ request()->is('dashboard/hr') ? 'active' : '' }}">
                        <i class="bi bi-house-door"></i>
                        Dashboard
                    </a>
                </li>

                <li>
                    <a href="{{ route('employees.index') }}"
                        class="{{ request()->routeIs('employees.*') ? 'active' : '' }}">
                        <i class="bi bi-people"></i>
                        Data Karyawan
                    </a>
                </li>

                <li>
                    <a href="{{ route('attendances.index') }}"
                        class="{{ request()->routeIs('attendances.index') ? 'active' : '' }}">
                        <i class="bi bi-calendar-check"></i>
                        Data Absensi
                    </a>
                </li>

                <li>
                    <a href="{{ route('attendances.monthly-report') }}"
                        class="{{ request()->routeIs('attendances.monthly-report') ? 'active' : '' }}">
                        <i class="bi bi-file-earmark-text"></i>
                        Laporan Bulanan
                    </a>
                </li>

                <li>
                    <a href="#">
                        <i class="bi bi-clock-history"></i>
                        Rekap Lembur
                    </a>
                </li>

                <li>
                    <a href="#">
                        <i class="bi bi-gear"></i>
                        Pengaturan
                    </a>
                </li>

            </ul>

            <div class="sidebar-footer">

                <a href="#" class="logout-btn">
                    <i class="bi bi-box-arrow-right"></i>
                    <form action="{{ route('logout') }}" method="POST">
                        @csrf

                        <button type="submit" class="dropdown-item">
                            Logout
                        </button>
                    </form>
                </a>

            </div>

        </div>

        <!-- Content -->
        <div class="main-content">

            <nav class="topbar">
                <h4>Sistem Absensi Digital</h4>

                <div class="user-info">
                    <i class="bi bi-person-circle"></i>
                    Admin HR
                </div>
            </nav>

            <div class="content">

                @if(session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
                @endif

                @if(session('error'))
                <div class="alert alert-danger">
                    {{ session('error') }}
                </div>
                @endif

                @yield('content')

            </div>

        </div>

    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</body>

</html>