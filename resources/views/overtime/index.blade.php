@extends('layouts.sidebar')

@section('content')

<div class="page-header mb-4">
    <div>
        <h2 class="page-title">Rekap Lembur</h2>
        <p class="page-subtitle">
            Total lembur seluruh karyawan
        </p>
    </div>
</div>

<div class="card employee-card border-0 shadow-sm">

    <div class="card-body">

        <div class="table-responsive">

            <table class="table align-middle employee-table">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Foto</th>
                        <th>ID Karyawan</th>
                        <th>Nama</th>
                        <th>Total Lembur</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse($overtimes as $overtime)
                    <tr>
                        <td>{{ $loop->iteration }}</td>

                        <td>

                            @if($overtime->employee && $overtime->employee->photo)

                            <img
                                src="{{ asset('uploads/employees/'.$overtime->employee->photo) }}"
                                width="50"
                                height="50"
                                class="employee-photo">

                            @else

                            <span class="badge bg-secondary">
                                No Photo
                            </span>

                            @endif

                        </td>

                        <td>{{ $overtime->employee_id }}</td>

                        <td>
                            {{ $overtime->employee->name ?? '-' }}
                        </td>

                        <td>
                            {{ number_format($overtime->total_overtime, 2) }} Jam
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="3" class="text-center">
                            Belum ada data lembur
                        </td>
                    </tr>
                    @endforelse
                </tbody>

            </table>
        </div>


    </div>
</div>

@endsection