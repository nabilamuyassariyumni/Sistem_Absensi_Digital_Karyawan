<?php

namespace App\Http\Controllers;

use App\Models\Attendances;
use App\Models\Employees;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

class DashboardController extends Controller
{
    //fungsi untuk menampilkan halaman dashboard
    public function index()
    {
        // Menghitung total karyawan
        $totalEmployees = Employees::count();

        // Menghitung jumlah karyawan yang hadir, terlambat, dan absen hari ini
        $presentToday = Attendances::whereDate('attendance_date', today())
            ->where('status', 'present')
            ->count();

        // Menghitung jumlah karyawan yang terlambat hari ini
        $lateToday = Attendances::whereDate('attendance_date', today())
            ->where('status', 'late')
            ->count();

        // Menghitung jumlah karyawan yang absen hari ini
        $absentToday = Attendances::whereDate('attendance_date', today())
            ->where('status', 'absent')
            ->count();

        // Mengambil 5 data absensi terbaru hari ini
        $todayAttendances = Attendances::whereDate('attendance_date', today())
            ->latest()
            ->take(5)
            ->get();

        // Mengirim data ke view dashboard
        return view('dashboard.index', compact(
            'totalEmployees',
            'presentToday',
            'lateToday',
            'absentToday',
            'todayAttendances',
        ));
    }

    //fungsi untuk menampilkan halaman laporan lembur
    public function overtimeReport()
    {
        // Mengambil data lembur karyawan
        $overtimes = Attendances::selectRaw(
            'employee_id, SUM(overtime_duration) as total_overtime'
        )
            ->with('employee')
            ->groupBy('employee_id')
            ->get();

        // Mengirim data ke view laporan lembur
        return view('overtime.index', compact('overtimes'));
    }

    //fungsi untuk menampilkan halaman laporan absensi
    public function attendanceData(Request $request)
    {
        // Mengambil data absensi karyawan berdasarkan tanggal yang dipilih
        $date = $request->date ?? today();

        // Mengambil data absensi karyawan berdasarkan tanggal yang dipilih
        $attendances = Attendances::with('employee')
            ->whereDate('attendance_date', $date)
            ->orderBy('employee_id')
            ->get();

        // Mengirim data ke view laporan absensi
        return view('attendances.index', compact(
            'attendances',
            'date'
        ));
    }

    //fungsi untuk menampilkan halaman laporan bulanan
    public function monthlyReport(Request $request)
    {
        // Mengambil data absensi karyawan berdasarkan bulan yang dipilih
        $month = $request->month ?? now()->format('Y-m');

        // Mengambil data absensi karyawan berdasarkan bulan yang dipilih
        $reports = \App\Models\Employees::with(['attendances' => function ($query) use ($month) {

            // Filter data absensi berdasarkan bulan yang dipilih
            $query->whereYear(
                'attendance_date',
                date('Y', strtotime($month))
            )
                ->whereMonth(
                    'attendance_date',
                    date('m', strtotime($month))
                );
        }])->get();

        // Mengirim data ke view laporan bulanan
        return view('reports.monthly', compact(
            'reports',
            'month'
        ));
    }

    //fungsi untuk export csv
    public function exportCsv(Request $request)
    {
        // Mengambil data absensi karyawan berdasarkan bulan yang dipilih
        $month = $request->month ?? now()->format('Y-m');

        // Mengambil data absensi karyawan berdasarkan bulan yang dipilih
        $reports = Employees::with(['attendances' => function ($query) use ($month) {

            $query->whereYear(
                'attendance_date',
                date('Y', strtotime($month))
            )
                ->whereMonth(
                    'attendance_date',
                    date('m', strtotime($month))
                );
        }])->get();

        // Menentukan nama file CSV
        $filename = 'Laporan_Absensi_' . $month . '.csv';

        // Mengirim data ke browser untuk diunduh sebagai file CSV
        return response()->streamDownload(function () use ($reports) {
            $handle = fopen('php://output', 'w');
            // Header CSV
            fputcsv($handle, [
                'Nama',
                'Hadir',
                'Terlambat',
                'Izin',
                'Alpha',
                'Total Lembur (Jam)'
            ]);

            // Menulis data absensi karyawan ke file CSV
            foreach ($reports as $employee) {
                fputcsv($handle, [
                    $employee->name,
                    $employee->attendances
                        ->where('status', 'present')
                        ->count(),
                    $employee->attendances
                        ->where('status', 'late')
                        ->count(),
                    $employee->attendances
                        ->where('status', 'leave')
                        ->count(),
                    $employee->attendances
                        ->where('status', 'absent')
                        ->count(),
                    number_format(
                        $employee->attendances->sum('overtime_duration'),
                        2
                    )
                ]);
            }
            fclose($handle);
        }, $filename);
    }

    //fungsi untuk export pdf
    public function exportPdf(Request $request)
    {
        // Mengambil data absensi karyawan berdasarkan bulan yang dipilih
        $month = $request->month ?? now()->format('Y-m');

        // Mengambil data absensi karyawan berdasarkan bulan yang dipilih
        $reports = Employees::with([
            'attendances' => function ($query) use ($month) {
                $query->whereYear(
                    'attendance_date',
                    date('Y', strtotime($month))
                )
                    ->whereMonth(
                        'attendance_date',
                        date('m', strtotime($month))
                    );
            }
        ])->get();

        // Mengirim data ke view laporan bulanan dalam format PDF
        $pdf = Pdf::loadView(
            'reports.pdf.monthly',
            compact('reports', 'month')
        );

        $pdf->setPaper('A4', 'landscape');

        return $pdf->download(
            'Laporan_Absensi_' . $month . '.pdf'
        );
    }

    public function hr()
    {
        $totalEmployees = Employees::count();

        $hadir = Attendances::whereDate('attendance_date', today())
            ->where('status', 'present')
            ->count();

        $terlambat = Attendances::whereDate('attendance_date', today())
            ->where('status', 'late')
            ->count();

        $izin = Attendances::whereDate('attendance_date', today())
            ->where('status', 'leave')
            ->count();

        $alpha = $totalEmployees - ($hadir + $terlambat + $izin);

        return view('dashboard.hr', compact(
            'hadir',
            'terlambat',
            'izin',
            'alpha'
        ));
    }
}
