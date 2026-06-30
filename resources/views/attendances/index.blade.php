@extends('layouts.sidebar')

@section('content')

<div class="page-header mb-4">
    <h2>Data Absensi</h2>
</div>

<div class="card shadow-sm border-0">

    <div class="card-body">

        <form method="GET" class="mb-3">

            <input
                type="date"
                name="date"
                value="{{ $date }}"
                class="form-control"
                style="max-width:250px">

        </form>

        <div class="table-responsive">

            <table class="table table-striped">

                <thead>
                    <tr>
                        <th>Foto</th>
                        <th>ID</th>
                        <th>Nama</th>
                        <th>Masuk</th>
                        <th>Keluar</th>
                        <th>Durasi</th>
                        <th>Status</th>
                    </tr>
                </thead>

                <tbody>

                    @forelse($attendances as $attendance)

                    <tr>

                        <td>

                            @if($attendance->employee && $attendance->employee->photo)

                            <img
                                src="{{ asset('uploads/employees/'.$attendance->employee->photo) }}"
                                width="50"
                                height="50"
                                class="employee-photo">

                            @else

                            <span class="badge bg-secondary">
                                No Photo
                            </span>

                            @endif

                        </td>

                        <td>
                            {{ $attendance->employee_id }}
                        </td>

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

                            @if($attendance->status == 'present')

                            <span class="badge bg-success">
                                Hadir
                            </span>

                            @elseif($attendance->status == 'late')

                            <span class="badge bg-warning text-dark">
                                Terlambat
                            </span>

                            @elseif($attendance->status == 'leave')

                            <span class="badge bg-info">
                                Izin
                            </span>

                            @else

                            <span class="badge bg-danger">
                                Tidak Hadir
                            </span>

                            @endif

                        </td>

                    </tr>

                    @empty

                    <tr>
                        <td colspan="7" class="text-center">
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