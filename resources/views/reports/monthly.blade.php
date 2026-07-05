@extends('layouts.sidebar')

@section('content')

<h2 class="page-title mb-4">Laporan Absensi Bulanan</h2>

<div class="card employee-card border-0 shadow-sm">

    <div class="card-body">

        <div class="d-flex justify-content-between align-items-center mb-4">

            <!-- Bulam -->
            <form method="GET" class="m-0">

                <input
                    type="month"
                    name="month"
                    value="{{ $month }}"
                    class="form-control"
                    style="width:250px">

            </form>

            <!-- Report -->
            <div class="report-actions">

                <a href="{{ route('monthly.report.pdf', ['month' => $month]) }}"
                    class="btn-export btn-pdf">

                    <i class="bi bi-file-earmark-pdf"></i>
                    Export PDF

                </a>

                <a href="{{ route('monthly.report.excel', ['month' => $month]) }}"
                    class="btn-export btn-excel">
                    <i class="bi bi-file-earmark-excel"></i>
                    Export Excel
                </a>

            </div>

        </div>

        <div class="table-responsive">

            <table class="table align-middle employee-table">

                <thead>
                    <tr>
                        <th>No</th>
                        <th>NIK</th>
                        <th>Nama</th>
                        <th>Hadir</th>
                        <th>Terlambat</th>
                        <th>Izin</th>
                        <th>Alpha</th>
                        <th>Total Lembur</th>
                    </tr>
                </thead>

                <tbody>

                    @foreach($reports as $employee)

                    <tr>

                        <td>
                            {{ $loop->iteration }}
                        </td>

                        <td>
                            {{ $employee->employee_id }}
                        </td>

                        <td>
                            {{ $employee->name }}
                        </td>

                        <td>
                            {{ $employee->attendances->where('status','present')->count() }}
                        </td>

                        <td>
                            {{ $employee->attendances->where('status','late')->count() }}
                        </td>

                        <td>
                            {{ $employee->attendances->where('status','leave')->count() }}
                        </td>

                        <td>
                            {{ $employee->attendances->where('status','absent')->count() }}
                        </td>

                        <td>
                            {{ number_format($employee->attendances->sum('overtime_duration'),2) }}
                            Jam
                        </td>

                    </tr>

                    @endforeach

                </tbody>

            </table>

        </div>

    </div>

</div>

@endsection