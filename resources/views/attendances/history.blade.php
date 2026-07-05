@extends('layouts.employee')

@section('content')

<div class="page-header mb-4">
    <h2>Riwayat Absensi Saya</h2>
</div>

<div class="card shadow-sm border-0">

    <div class="card-body">

        <div class="table-responsive">

            <table class="table history-table">

                <thead>
                    <tr>
                        <th width="60">No</th>
                        <th>Tanggal</th>
                        <th>Jam Masuk</th>
                        <th>Jam Keluar</th>
                        <th>Durasi Kerja</th>
                        <th>Status</th>
                    </tr>
                </thead>

                <tbody>

                    @forelse($attendances as $attendance)

                    <tr>

                        <td>{{ $loop->iteration }}</td>

                        <td>
                            {{ \Carbon\Carbon::parse($attendance->attendance_date)->translatedFormat('d F Y') }}
                        </td>

                        <td>
                            {{ $attendance->check_in ?? '-' }}
                        </td>

                        <td>
                            {{ $attendance->check_out ?? '-' }}
                        </td>

                        <td>
                            @if($attendance->check_out)
                            {{ number_format($attendance->work_duration,2) }} Jam
                            @else
                            -
                            @endif
                        </td>

                        <!-- Kolom Statyes -->
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
                        <td colspan="6" class="text-center py-4">
                            Belum ada riwayat absensi
                        </td>
                    </tr>

                    @endforelse

                </tbody>

            </table>

        </div>

        <div class="mt-3">

            {{ $attendances->links() }}

        </div>

    </div>

</div>

@endsection