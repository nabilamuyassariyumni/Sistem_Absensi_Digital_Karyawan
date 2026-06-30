<?php

namespace App\Http\Controllers;

use App\Models\Attendances;
use App\Models\Employees;
use Illuminate\Http\Request;

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
}
