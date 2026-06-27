<?php

namespace App\Http\Controllers;

use App\Models\Attendances;
use Illuminate\Http\Request;

class EmployeeDashboardController extends Controller
{
    public function index()
    {
        $employeeId = request()->user()->employee->employee_id;

        $hadir = Attendances::where('employee_id', $employeeId)
            ->where('status', 'present')
            ->count();

        $terlambat = Attendances::where('employee_id', $employeeId)
            ->where('status', 'late')
            ->count();

        $izin = Attendances::where('employee_id', $employeeId)
            ->where('status', 'leave')
            ->count();

        $lembur = Attendances::where('employee_id', $employeeId)
            ->sum('overtime_duration');

        $attendances = Attendances::where('employee_id', $employeeId)
            ->latest('attendance_date')
            ->get();

        $todayAttendance = Attendances::where('employee_id', $employeeId)
            ->whereDate('attendance_date', today())
            ->first();

        return view('dashboard.employee', compact(
            'todayAttendance',
            'attendances',
            'hadir',
            'terlambat',
            'izin',
            'lembur'
        ));
    }
}
