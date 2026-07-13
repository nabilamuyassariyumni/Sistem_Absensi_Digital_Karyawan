<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Sistem Absensi Karyawan</title>

    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">

    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>

<body class="employee-theme">

    <div class="main-wrapper">

        <!-- SIDEBAR -->
        <aside class="sidebar">

            <div class="logo">

                <div class="logo-icon">
                    <i class="bi bi-people-fill"></i>
                </div>

                <span>Sistem Absensi</span>

            </div>

            <ul class="nav-menu">

                <li>
                    <a href="{{ route('dashboard.employee') }}"
                        class="{{ request()->routeIs('dashboard.employee') ? 'active' : '' }}">

                        <i class="bi bi-house-door"></i>
                        Dashboard

                    </a>
                </li>

                <li>

                    <a href="{{ route('attendances.history') }}"
                        class="{{ request()->routeIs('attendances.history') ? 'active' : '' }}">
                        <i class="bi bi-clock-history"></i>
                        Riwayat Absensi
                    </a>
                </li>

                <li>
                    <a href="{{ route('employee.profile') }}"
                        class="{{ request()->routeIs('employee.profile') ? 'active' : '' }}">
                        <i class="bi bi-person"></i>
                        Profil Saya
                    </a>
                </li>

            </ul>

            <div class="sidebar-footer">

                <form action="{{ route('logout') }}" method="POST">
                    @csrf

                    <button type="submit" class="logout-btn border-0 bg-transparent w-100 text-start">

                        <i class="bi bi-box-arrow-right"></i>
                        Logout

                    </button>

                </form>

            </div>

        </aside>

        <!-- CONTENT -->
        <main class="main-content">

            <div class="content">
                @yield('content')
            </div>

        </main>

    </div>

</body>

</html>