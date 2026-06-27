@extends('layouts.employee')

@section('content')

<div class="employee-header d-flex justify-content-between align-items-center mb-4">

    <div>
        <h2 class="fw-bold mb-1">
            Selamat pagi, {{ auth()->user()->name }}
        </h2>

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
            {{ $todayAttendance?->status ?? 'Belum Absen' }}
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
                        {{ $todayAttendance?->check_in ?? '-' }}
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
                        {{ $todayAttendance?->check_out ?? '-' }}
                    </h2>
                </div>

            </div>

        </div>

    </div>

    <form
        id="attendanceForm"
        method="POST"
        action="{{ !$todayAttendance
        ? route('attendances.checkin')
        : route('attendances.checkout') }}">

        @csrf

        <input type="hidden" name="latitude" id="latitude">
        <input type="hidden" name="longitude" id="longitude">

        <button type="submit" class="btn btn-checkout w-100 mt-4 blue">

            <i class="bi bi-geo-alt"></i>

            {{ !$todayAttendance
            ? 'Check In Sekarang'
            : 'Check Out Sekarang' }}

        </button>

    </form>

</div>

<!-- STATISTIK -->

<div class="row g-4 mb-4">

    <div class="col-md-3">

        <div class="employee-stat">

            <div class="d-flex justify-content-between">

                <div>
                    <p class="mb-1 text-muted">Hadir</p>
                    <h2>{{ $hadir }}</h2>
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
                    <h2>{{ $terlambat }}</h2>
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
                    <p class="mb-1 text-muted">Izin</p>
                    <h2>{{ $izin }}</h2>
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
                    <h2>{{ number_format($lembur, 1) }}j</h2>
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
            @foreach($attendances->take(7) as $attendance)
            <tr>

                <td>
                    {{ $attendance->attendance_date->format('d M') }}
                </td>

                <td>{{ $attendance->check_in ?? '-' }}</td>

                <td>{{ $attendance->check_out ?? '-' }}</td>

                <td>

                    @if($attendance->status == 'present')
                    <span class="badge-custom badge-hadir">
                        Hadir
                    </span>

                    @elseif($attendance->status == 'late')
                    <span class="badge-custom badge-terlambat">
                        Terlambat
                    </span>

                    @endif

                </td>

                <td>
                    {{ $attendance->overtime_duration ?? 0 }} Jam
                </td>

            </tr>
            @endforeach
        </tbody>
    </table>
</div>

<script>
    navigator.geolocation.getCurrentPosition(function(position) {

        document.getElementById('latitude').value =
            position.coords.latitude;

        document.getElementById('longitude').value =
            position.coords.longitude;

    });
</script>

@endsection