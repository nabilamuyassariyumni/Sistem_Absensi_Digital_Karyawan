@extends('layouts.sidebar')

@section('content')

<h2 class="page-title mb-4">Dashboard</h2>

<!-- Statistik -->
<div class="row g-4 mb-4">

    <div class="col-md-3">
        <div class="dashboard-card">
            <div>
                <span class="card-label">Karyawan</span>
                <h3>{{ $totalEmployees }}</h3>
                <small>Total Karyawan</small>
            </div>

            <div class="card-icon blue">
                <i class="bi bi-people-fill"></i>
            </div>
        </div>
    </div>

    <div class="col-md-3">
        <div class="dashboard-card">
            <div>
                <span class="card-label">Hadir Hari Ini</span>
                <h3>{{ $presentToday }}</h3>
                <small>Karyawan</small>
            </div>

            <div class="card-icon green">
                <i class="bi bi-person-check-fill"></i>
            </div>
        </div>
    </div>

    <div class="col-md-3">
        <div class="dashboard-card">
            <div>
                <span class="card-label text-danger">Terlambat</span>
                <h3>{{ $lateToday }}</h3>
                <small>Karyawan</small>
            </div>

            <div class="card-icon red">
                <i class="bi bi-alarm-fill"></i>
            </div>
        </div>
    </div>

    <div class="col-md-3">
        <div class="dashboard-card">
            <div>
                <span class="card-label">Tidak Hadir</span>
                <h3>{{ $absentToday }}</h3>
                <small>Karyawan</small>
            </div>

            <div class="card-icon orange">
                <i class="bi bi-person-x-fill"></i>
            </div>
        </div>
    </div>

</div>

<!-- Grafik + Absensi Hari Ini -->
<div class="row g-4">

    <!-- Absensi Hari Ini -->
    <div class="col-lg-12">
        <div class="card border-0 shadow-sm dashboard-panel">
            <div class="card-body">
                <div class="d-flex justify-content-between mb-3">
                    <h5>Absensi Hari Ini</h5>
                    <a href="{{ route('attendances.admin') }}" class="small text-decoration-none">
                        Lihat Semua
                    </a>
                </div>

                <div class="card employee-card border-0 shadow-sm">
                    <div class="table-responsive">
                        <table class="table align-middle employee-table">
                            <thead>
                                <tr>
                                    <th>NIK</th>
                                    <th>Nama Karyawan</th>
                                    <th>Jam Masuk</th>
                                    <th>Jam Keluar</th>
                                    <th>Durasi Kerja</th>
                                    <th>Lembur</th>
                                    <th>Status</th>
                                </tr>
                            </thead>

                            <tbody>

                                @forelse($todayAttendances as $index => $attendance)

                                <tr>
                                    <td>{{ $attendance->employee_id }}</td>

                                    <td>
                                        {{ $attendance->employee->name ?? '-' }}
                                    </td>

                                    <td>
                                        {{ $attendance->check_in ?? '-' }}
                                    </td>

                                    <td>
                                        {{ $attendance->check_out ?? '-' }}
                                    </td>

                                    <td>
                                        {{ $attendance->work_duration ?? 0 }} Jam
                                    </td>

                                    <td>
                                        {{ $attendance->overtime_duration ?? 0 }} Jam
                                    </td>

                                    <td>

                                        @if($attendance->check_in && !$attendance->check_out)

                                        <span class="status-badge status-working">
                                            Sedang Bekerja
                                        </span>

                                        @elseif($attendance->status == 'present')

                                        <span class="status-badge status-present">
                                            Hadir
                                        </span>

                                        @elseif($attendance->status == 'late')

                                        <span class="status-badge status-late">
                                            Terlambat
                                        </span>

                                        @elseif($attendance->status == 'leave')

                                        <span class="status-badge status-leave">
                                            Izin
                                        </span>

                                        @else

                                        <span class="status-badge status-absent">
                                            Alpha
                                        </span>

                                        @endif

                                    </td>
                                </tr>

                                @empty

                                <tr>
                                    <td colspan="8" class="text-center py-4">
                                        Belum ada data absensi hari ini
                                    </td>
                                </tr>

                                @endforelse

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Grafik -->
    <!-- <div class="col-lg-12">
        <div class="card border-0 shadow-sm dashboard-panel">
            <div class="card-body">
                <div class="d-flex justify-content-between mb-3">
                    <h5>Statistik Kehadiran Bulan Ini</h5>
                    <select class="form-select w-auto">
                        <option>Juni 2026</option>
                    </select>
                </div>

                <div class="chart-placeholder">
                    <div class="line-chart-demo">
                        <div class="line"></div>
                    </div>
                </div>
            </div>
        </div>
    </div> -->
</div>

@endsection