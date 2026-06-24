@extends('layouts.main')

@section('content')
<div class="container py-4">

    <h2 class="mb-4">Absensi Karyawan</h2>

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

    {{-- STATUS HARI INI --}}
    <div class="card shadow-sm mb-4">
        <div class="card-header">
            Status Hari Ini
        </div>

        <div class="card-body">

            <div class="row text-center mb-4">

                <div class="col-md-3">
                    <h6>Jam Masuk</h6>
                    <h4 class="text-success">
                        {{ $todayAttendance?->check_in ?? '-' }}
                    </h4>
                </div>

                <div class="col-md-3">
                    <h6>Jam Keluar</h6>
                    <h4 class="text-danger">
                        {{ $todayAttendance?->check_out ?? '-' }}
                    </h4>
                </div>

                <div class="col-md-3">
                    <h6>Durasi Kerja</h6>
                    <h4 class="text-primary">
                        {{ $todayAttendance?->work_duration ?? 0 }} Jam
                    </h4>
                </div>

                <div class="col-md-3">
                    <h6>Lembur</h6>
                    <h4 class="text-warning">
                        {{ $todayAttendance?->overtime_duration ?? 0 }} Jam
                    </h4>
                </div>

            </div>

            {{-- PETA --}}
            <div class="mb-4">
                <label class="form-label fw-semibold">
                    Lokasi Saat Ini
                </label>

                <div
                    id="map"
                    class="border rounded"
                    style="height:300px;">
                </div>
            </div>

            {{-- TOMBOL ABSENSI --}}
            @if(!$todayAttendance)

            <form action="{{ route('attendances.checkin') }}"
                method="POST">

                @csrf

                <input type="hidden"
                    name="latitude"
                    id="latitude">

                <input type="hidden"
                    name="longitude"
                    id="longitude">

                <button
                    type="submit"
                    class="btn btn-primary w-100">

                    Check In Sekarang

                </button>
            </form>

            @elseif(!$todayAttendance->check_out)

            <form action="{{ route('attendances.checkout') }}"
                method="POST">

                @csrf

                <button
                    type="submit"
                    class="btn btn-danger w-100">

                    Check Out Sekarang

                </button>
            </form>

            @else

            <div class="alert alert-success text-center mb-0">
                ✓ Absensi hari ini sudah selesai
            </div>

            @endif

        </div>
    </div>

    {{-- RIWAYAT ABSENSI --}}
    <div class="card shadow-sm">

        <div class="card-header">
            Riwayat Absensi
        </div>

        <div class="card-body">

            <table class="table table-hover">

                <thead>
                    <tr>
                        <th>Tanggal</th>
                        <th>Masuk</th>
                        <th>Keluar</th>
                        <th>Durasi</th>
                        <th>Lembur</th>
                    </tr>
                </thead>

                <tbody>

                    @forelse($attendances as $attendance)

                    <tr>

                        <td>
                            {{ $attendance->attendance_date }}
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

                    </tr>

                    @empty

                    <tr>
                        <td colspan="5" class="text-center">
                            Belum ada data absensi
                        </td>
                    </tr>

                    @endforelse

                </tbody>

            </table>

        </div>

    </div>

</div>
@endsection

@section('scripts')

<link rel="stylesheet"
    href="https://unpkg.com/leaflet/dist/leaflet.css" />

<script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>

<script>
    navigator.geolocation.getCurrentPosition(function(position) {

        let lat = position.coords.latitude;
        let lng = position.coords.longitude;

        let latitude = document.getElementById('latitude');
        let longitude = document.getElementById('longitude');

        if (latitude) {
            latitude.value = lat;
        }

        if (longitude) {
            longitude.value = lng;
        }

        let map = L.map('map').setView([lat, lng], 16);

        L.tileLayer(
            'https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                attribution: '&copy; OpenStreetMap'
            }
        ).addTo(map);

        L.marker([lat, lng])
            .addTo(map)
            .bindPopup('Lokasi Anda')
            .openPopup();

    });
</script>

@endsection