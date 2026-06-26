@extends('layouts.employee')

@section('content')

<div class="employee-header d-flex justify-content-between align-items-center mb-4">

    <div>
        <h1 class="fw-bold mb-1">
            Selamat pagi, {{ auth()->user()->name }}
        </h1>

        <p class="text-muted mb-0">
            {{ now()->translatedFormat('l, d F Y') }}
        </p>
    </div>

    <div class="user-info">
        <span>{{ auth()->user()->name }}</span>

        <img
            src="https://cdn-icons-png.flaticon.com/512/3135/3135715.png"
            class="user-avatar">

        <i class="bi bi-chevron-down"></i>
    </div>

</div>

<!-- STATUS HARI INI -->

<div class="employee-card mb-4">

    <div class="d-flex justify-content-between align-items-center mb-4">

        <h3 class="fw-bold mb-0">
            Status hari ini
        </h3>

        <span class="status-badge">
            Hadir
        </span>

    </div>

    <div class="row g-4">

        <div class="col-md-6">

            <div class="time-box">

                <div class="attendance-icon icon-checkin">
                    <i class="bi bi-box-arrow-in-right"></i>
                </div>

                <div>
                    <small class="text-muted">
                        Jam masuk
                    </small>

                    <h2 class="fw-bold mb-0">
                        08:02
                    </h2>
                </div>

            </div>

        </div>

        <div class="col-md-6">

            <div class="time-box">

                <div class="attendance-icon icon-checkout">
                    <i class="bi bi-box-arrow-right"></i>
                </div>

                <div>
                    <small class="text-muted">
                        Jam keluar
                    </small>

                    <h2 class="fw-bold mb-0">
                        -
                    </h2>
                </div>

            </div>

        </div>

    </div>

    <button class="btn btn-checkout w-100 mt-4 blue">
        <i class="bi bi-geo-alt"></i>
        Check-Out Sekarang
    </button>

</div>

<!-- STATISTIK -->

<div class="row g-4 mb-4">

    <div class="col-md-3">

        <div class="employee-stat">

            <div class="d-flex justify-content-between">

                <div>
                    <p class="mb-1 text-muted">Hadir</p>
                    <h2>18</h2>
                </div>

                <div class="employee-stat-icon stat-green">
                    <i class="bi bi-person-check"></i>
                </div>

            </div>

        </div>

    </div>

    <div class="col-md-3">

        <div class="employee-stat">

            <div class="d-flex justify-content-between">

                <div>
                    <p class="mb-1 text-muted">Terlambat</p>
                    <h2>2</h2>
                </div>

                <div class="employee-stat-icon stat-orange">
                    <i class="bi bi-clock-history"></i>
                </div>

            </div>

        </div>

    </div>

    <div class="col-md-3">

        <div class="employee-stat">

            <div class="d-flex justify-content-between">

                <div>
                    <p class="mb-1 text-muted">Izin/Cuti</p>
                    <h2>1</h2>
                </div>

                <div class="employee-stat-icon stat-purple">
                    <i class="bi bi-calendar-check"></i>
                </div>

            </div>

        </div>

    </div>

    <div class="col-md-3">

        <div class="employee-stat">

            <div class="d-flex justify-content-between">

                <div>
                    <p class="mb-1 text-muted">Lembur</p>
                    <h2>5j</h2>
                </div>

                <div class="employee-stat-icon stat-blue">
                    <i class="bi bi-moon-stars"></i>
                </div>

            </div>

        </div>

    </div>

</div>

<!-- RIWAYAT -->

<div class="history-card">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h3 class="fw-bold mb-0">
            Riwayat minggu ini
        </h3>
        <a href="#" class="text-decoration-none">
            Lihat semua
        </a>
    </div>

    <table class="table align-middle">
        <thead>
            <tr>
                <th>Tanggal</th>
                <th>Masuk</th>
                <th>Keluar</th>
                <th>Status</th>
                <th>Lembur</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>20 Jun</td>
                <td>08:00</td>
                <td>17:05</td>
                <td>
                    <span class="badge-custom badge-hadir">
                        Hadir
                    </span>
                </td>
                <td>5</td>
            </tr>

            <tr>
                <td>19 Jun</td>
                <td>08:21</td>
                <td>17:00</td>
                <td>
                    <span class="badge-custom badge-terlambat">
                        Terlambat
                    </span>
                </td>
                <td>5</td>
            </tr>

            <tr>
                <td>18 Jun</td>
                <td>07:55</td>
                <td>18:30</td>
                <td>
                    <span class="badge-custom badge-lembur">
                        Lembur
                    </span>
                </td>
                <td>5</td>
            </tr>
        </tbody>
    </table>
</div>

@endsection