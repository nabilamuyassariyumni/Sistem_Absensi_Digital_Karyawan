<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SIAD - Sistem Absensi Digital</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">

    <style>
        body {
            background-color: #f5f6fa;
        }

        .sidebar {
            min-height: 100vh;
            background: #212529;
        }

        .sidebar a {
            color: white;
            text-decoration: none;
            display: block;
            padding: 12px;
        }

        .sidebar a:hover {
            background: #343a40;
        }

        .content {
            padding: 20px;
        }

        .navbar-brand {
            font-weight: bold;
        }
    </style>
</head>

<body>

    <div class="container-fluid">
        <div class="row">

            <!-- Sidebar -->
            <div class="col-md-2 sidebar">

                <h4 class="text-white text-center py-3">
                    SIAD
                </h4>

                <a href="/">
                    Dashboard
                </a>

                <a href="{{ route('employees.index') }}">
                    Data Karyawan
                </a>

                <a href="{{ route('attendances.index') }}">
                    Absensi
                </a>

                <a href="{{ route('attendances.monthly-report') }}">
                    Laporan
                </a>

            </div>

            <!-- Content -->
            <div class="col-md-10">

                <nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm mb-3">
                    <div class="container-fluid">
                        <span class="navbar-brand">
                            Sistem Absensi Digital
                        </span>
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
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</body>

</html>