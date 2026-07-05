<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">

    <link rel="stylesheet" href="{{ public_path('css/pdf-report.css') }}">

</head>

<body>

    <!-- HEADER -->

    <div class="company-header">

        <table>

            <tr>

                <td width="70">

                    <div class="logo-box">
                        <i class="bi bi-people "></i>
                    </div>

                </td>

                <td>

                    <div class="system-title">
                        SIAD - SISTEM ABSENSI DIGITAL
                    </div>

                    <div class="system-subtitle">
                        Laporan Absensi & Rekap Lembur
                    </div>

                </td>

                <td class="company-info">

                    <h3>PT. Maju Bersama</h3>

                    <p>Jl. Merdeka No.123, Jakarta Selatan</p>

                    <p>Telp : (021)1234567</p>

                    <p>Email : hr@maju-bersama.com</p>

                </td>

            </tr>

        </table>

    </div>

    <div class="blue-line"></div>

    <!-- TITLE -->

    <div class="report-title">

        <h2>LAPORAN ABSENSI & REKAP LEMBUR</h2>

        <h3>
            Periode :
            {{ \Carbon\Carbon::parse($month)->translatedFormat('F Y') }}
        </h3>

    </div>

    <!-- TABLE -->

    <table class="report-table">

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

            @php
            $hadir=0;
            $izin=0;
            $alpha=0;
            $late=0;
            $overtime=0;
            @endphp

            @foreach($reports as $employee)

            @php

            $h = $employee->attendances->where('status','present')->count();
            $l = $employee->attendances->where('status','late')->count();
            $i = $employee->attendances->where('status','leave')->count();
            $a = $employee->attendances->where('status','absent')->count();
            $o = $employee->attendances->sum('overtime_duration');

            $hadir += $h;
            $late += $l;
            $izin += $i;
            $alpha += $a;
            $overtime += $o;

            @endphp

            <tr>

                <td>{{ $loop->iteration }}</td>

                <td>{{ $employee->employee_id }}</td>

                <td class="text-left">
                    {{ $employee->name }}
                </td>

                <td>{{ $h }}</td>

                <td>{{ $l }}</td>

                <td>{{ $i }}</td>

                <td>{{ $a }}</td>

                <td>{{ number_format($o,2) }} Jam</td>

            </tr>

            @endforeach

        </tbody>

        <tfoot>

            <tr>

                <td colspan="3">
                    TOTAL
                </td>

                <td>{{ $hadir }}</td>

                <td>{{ $late }}</td>

                <td>{{ $izin }}</td>

                <td>{{ $alpha }}</td>

                <td>{{ number_format($overtime,2) }} Jam</td>

            </tr>

        </tfoot>

    </table>

    <!-- NOTE -->

    <div class="note">

        <h4>Catatan :</h4>

        <p>- Total hari kerja mengikuti kalender perusahaan.</p>

        <p>- Perhitungan lembur mengikuti kebijakan perusahaan.</p>

    </div>

    <!-- SIGN -->

    <br><br>
    <div class="signature">

        <p>
            Jakarta,
            {{ now()->translatedFormat('d F Y') }}
        </p>

        <br>

        <strong>PT. Maju Bersama</strong>

        <div class="space"></div>

        <div class="line"></div>

        Admin HR

    </div>

    <div class="footer-line"></div>

</body>

</html>