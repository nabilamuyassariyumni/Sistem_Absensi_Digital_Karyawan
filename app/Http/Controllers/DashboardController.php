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
            'todayAttendances'
        ));
    }
}
