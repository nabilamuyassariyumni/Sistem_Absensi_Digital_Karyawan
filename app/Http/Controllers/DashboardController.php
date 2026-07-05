<?php

namespace App\Http\Controllers;

use App\Models\Attendances;
use App\Models\Employees;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

class DashboardController extends Controller
{
    public function index()
    {
        $totalEmployees = Employees::count();

        $presentToday = Attendances::whereDate('attendance_date', today())
            ->where('status', 'present')
            ->count();

        $lateToday = Attendances::whereDate('attendance_date', today())
            ->where('status', 'late')
            ->count();

        $absentToday = Attendances::whereDate('attendance_date', today())
            ->where('status', 'absent')
            ->count();

        $todayAttendances = Attendances::whereDate('attendance_date', today())
            ->latest()
            ->take(5)
            ->get();


        return view('dashboard.index', compact(
            'totalEmployees',
            'presentToday',
            'lateToday',
            'absentToday',
            'todayAttendances',
        ));
    }

    public function overtimeReport()
    {
        $overtimes = Attendances::selectRaw(
            'employee_id, SUM(overtime_duration) as total_overtime'
        )
            ->with('employee')
            ->groupBy('employee_id')
            ->get();

        return view('overtime.index', compact('overtimes'));
    }

    public function attendanceData(Request $request)
    {
        $date = $request->date ?? today();

        $attendances = Attendances::with('employee')
            ->whereDate('attendance_date', $date)
            ->orderBy('employee_id')
            ->get();

        return view('attendances.index', compact(
            'attendances',
            'date'
        ));
    }

    public function monthlyReport(Request $request)
    {
        $month = $request->month ?? now()->format('Y-m');

        $reports = \App\Models\Employees::with(['attendances' => function ($query) use ($month) {

            $query->whereYear(
                'attendance_date',
                date('Y', strtotime($month))
            )
                ->whereMonth(
                    'attendance_date',
                    date('m', strtotime($month))
                );
        }])->get();

        return view('reports.monthly', compact(
            'reports',
            'month'
        ));
    }

    public function exportCsv(Request $request)
    {
        $month = $request->month ?? now()->format('Y-m');

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

        $filename = 'Laporan_Absensi_' . $month . '.csv';

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

    public function exportPdf(Request $request)
    {
        $month = $request->month ?? now()->format('Y-m');

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

        $pdf = Pdf::loadView(
            'reports.pdf.monthly',
            compact('reports', 'month')
        );

        $pdf->setPaper('A4', 'landscape');

        return $pdf->download(
            'Laporan_Absensi_' . $month . '.pdf'
        );
    }
}
