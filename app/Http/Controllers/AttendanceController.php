<?php

namespace App\Http\Controllers;

use App\Models\Attendances;
use Carbon\Carbon;
use Illuminate\Http\Request;

class AttendanceController extends Controller
{
    public function index()
    {
        $employeeId = auth()->user()->employee->employee_id;

        $todayAttendance = Attendances::where('employee_id', $employeeId)
            ->whereDate('attendance_date', today())
            ->first();

        $attendances = Attendances::where('employee_id', $employeeId)
            ->latest()
            ->get();

        return view('attendances.index', compact(
            'todayAttendance',
            'attendances'
        ));
    }

    public function checkIn(Request $request)
    {
        $employeeId = auth()->user()->employee->employee_id;

        $attendance = Attendances::where('employee_id', $employeeId)
            ->whereDate('attendance_date', today())
            ->first();

        if ($attendance) {
            return back()->with('error', 'Anda sudah check in hari ini');
        }

        Attendances::create([
            'employee_id' => $employeeId,
            'attendance_date' => today(),
            'check_in' => now()->format('H:i:s'),
            'latitude' => $request->latitude,
            'longitude' => $request->longitude,
            'status' => 'present',
        ]);

        return back()->with('success', 'Check In berhasil');
    }

    public function checkOut(Request $request)
    {
        $employeeId = auth()->user()->employee->employee_id;

        $attendance = Attendances::where('employee_id', $employeeId)
            ->whereDate('attendance_date', today())
            ->first();

        if (!$attendance) {
            return back()->with('error', 'Silahkan Check In terlebih dahulu');
        }

        if ($attendance->check_out) {
            return back()->with('error', 'Anda sudah Check Out');
        }

        $checkIn = Carbon::parse($attendance->check_in);
        $checkOut = Carbon::now();

        $minutes = $checkIn->diffInMinutes($checkOut);
        $workDuration = round($minutes / 60, 2);

        $overtime = 0;

        if ($workDuration > 8) {
            $overtime = round($workDuration - 8, 2);
        }

        $attendance->update([
            'check_out' => $checkOut->format('H:i:s'),
            'work_duration' => $workDuration,
            'overtime_duration' => $overtime,
        ]);

        return back()->with('success', 'Check Out berhasil');
    }
}
